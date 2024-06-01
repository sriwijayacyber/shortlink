<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use App\Models\AppSetting;
use App\Models\SmtpSetting;
use App\Models\SocialLogin;
use App\Rules\XSSPurifier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Inertia\Inertia;

class AppSettingsController extends Controller
{
    private $config;

    public function __construct()
    {
        $this->config = base_path('config/app.php');
    }

    public function configRewrite($key, $prevValue, $newValue)
    {
        file_put_contents(
            $this->config,
            str_replace("'$key' => '" . $prevValue . "'", "'$key' => '" . $newValue . "'", file_get_contents($this->config))
        );
    }


    // Getting app info
    public function index(Request $req)
    {
        try {
            $app = AppSetting::first();
            $smtp = SmtpSetting::first();
            $google = SocialLogin::where('name', 'google')->first();

            return Inertia::render('Admin/AppSettings', compact('app', 'smtp', 'google'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    // Auth settings for admin
    public function auth_google(Request $request)
    {
        $request->validate([
            'google_client_id' => 'max:200',
            'google_client_secret' => 'max:100',
            'google_redirect' => 'max:100',
        ]);
        $google_login_allow = $request->google_login_allow ? true : false;

        try {
            SocialLogin::where('name', 'google')->update([
                'active' => $google_login_allow,
                'client_id' => $request->google_client_id,
                'client_secret' => $request->google_client_secret,
                'redirect_url' => $request->google_redirect,
            ]);

            return back()->with('success', 'Google auth successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // Global settings for admin
    public function app_update(Request $request)
    {
        $request->validate([
            'title' => ['required', 'max:50', new XSSPurifier],
            'copyright' => ['required', 'max:100', new XSSPurifier],
            'description' => ['required', 'max:200', new XSSPurifier],
        ]);
        if ($request->logo) {
            $request->validate([
                'logo' => ['image', 'mimes:jpeg,png,jpg,svg', 'max:2048'],
            ]);
        }

        try {
            $app = AppSetting::first();

            if ($request->logo) {
                if (strpos($app->logo, "asses/icons") !== false) {
                    File::delete($app->logo);
                }
                $imgUrl = AppHelper::image_uploader($request->logo);
                $app->logo = $imgUrl;
            }

            $app->title = $request->title;
            $app->copyright = $request->copyright;
            $app->description = $request->description;
            $app->save();

            return back()->with('success', 'Global settings successfully updated.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Internal server error!. Try again later.');
        }
    }


    // SMTP settings for admin
    public function smtp_update(Request $request)
    {
        $request->validate([
            'host' => 'required|max:50',
            'port' => 'required|max:10',
            'username' => 'required|max:50',
            'password' => 'required|max:100',
            'encryption' => 'required|max:10',
            'from_address' => 'required|max:100|email',
            'from_name' => 'required|max:50',
            'admin_email' => 'required|max:50',
        ]);

        try {
            config(['mail.mailers.smtp.host' => $request->host]);
            config(['mail.mailers.smtp.port' => (int) $request->port]);
            config(['mail.mailers.smtp.username' => $request->username]);
            config(['mail.mailers.smtp.password' => $request->password]);
            config(['mail.mailers.smtp.encryption' => $request->encryption]);
            config(['mail.from.address' => $request->from_address]);
            config(['mail.from.name' => $request->from_name]);

            Mail::raw('This is a test email.', function ($message) use ($request) {
                $message->to($request->admin_email, 'Recipient Name');
                $message->subject('Test Email');
                $message->from($request->from_address, 'Test');
            });

            $smtp = SmtpSetting::first();

            $smtp->host = $request->host;
            $smtp->port = $request->port;
            $smtp->username = $request->username;
            $smtp->password = $request->password;
            $smtp->encryption = $request->encryption;
            $smtp->sender_email = $request->from_address;
            $smtp->sender_name = $request->from_name;
            $smtp->save();

            return back()->with('success', 'SMTP connection is successfully established');
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }


    public function appControl()
    {
        try {
            $version = File::get(base_path() . '/version.txt');

            return Inertia::render('Admin/AppControl', compact('version'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
