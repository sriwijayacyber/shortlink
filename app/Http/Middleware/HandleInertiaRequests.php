<?php

namespace App\Http\Middleware;

use App\Models\AppSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Inertia\Middleware;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        try {
            DB::connection()->getPdo();
        } catch (\Throwable $th) {
            return [];
        }

        $app = null;
        if (Schema::hasTable('app_settings')) {
            $app = AppSetting::first();
        }

        $user = null;
        if ($request->user()) {
            $user = User::where('id', $request->user()->id)->with('roles')->first();
        }

        $locale = $request->cookie('locale');
        if ($locale) {
            App::setLocale($locale);
        }

        $languages = [];
        $langs = scandir(base_path('lang'));
        array_shift($langs);
        array_shift($langs);

        foreach ($langs as $lang) {
            $langFilePath = base_path("lang/$lang/active.txt");
            if (is_file($langFilePath)) {
                array_push($languages, ['code' => $lang, 'active' => true]);
            } else {
                array_push($languages, ['code' => $lang, 'active' => false]);
            }
        }

        return array_merge(parent::share($request), [
            'app' => $app,
            'auth' => ['user' => $user],
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'error' => fn () => $request->session()->get('error'),
                'warning' => fn () => $request->session()->get('warning'),
                'success' => fn () => $request->session()->get('success'),
            ],
            'translate' => [
                'langs' => $languages,
                'locale' => $locale,
                'app' => trans('app'),
                'input' => trans('input'),
            ],
        ]);

        // $sharedData = parent::share($request);

        // // Check if AppSetting exists and is not null
        // if (Schema::hasTable('app_settings')) {
        //     $sharedData['app'] = AppSetting::first();
        // }

        // $sharedData['auth'] = [
        //     'user' => $request->user() ? User::where('id', $request->user()->id)->with('roles')->first() : $request->user(),
        // ];

        // $sharedData['ziggy'] = function () use ($request) {
        //     return array_merge((new Ziggy)->toArray(), [
        //         'location' => $request->url(),
        //     ]);
        // };

        // $sharedData['flash'] = [
        //     'error' => fn () => $request->session()->get('error'),
        //     'warning' => fn () => $request->session()->get('warning'),
        //     'success' => fn () => $request->session()->get('success'),
        // ];

        // return $sharedData;
    }
}
