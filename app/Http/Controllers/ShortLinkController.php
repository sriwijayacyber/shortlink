<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Illuminate\Http\Request;
use App\Models\Link;
use App\Models\QRCode;
use App\Models\Language;
use App\Models\LinkItem;
use App\Models\PricingPlan;
use App\Models\ShetabitVisit;
use App\Rules\CheckLinkName;
use App\Rules\XSSPurifier;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Illuminate\Validation\Rule;
use Inertia\Inertia;


class ShortLinkController extends Controller
{
    // Getting the total bio-links of user
    public function index(Request $req)
    {
        try {
            $linkLimit = 0;
            $user = auth()->user();
            $SA = $user->hasRole('SUPER-ADMIN');
            $plan = PricingPlan::where('id', $user->pricing_plan_id)->first();
            $page = $req->per_page ? intval($req->per_page) : 10;

            $links = Link::when(!$SA, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
                ->where('link_type', 'shortlink')
                ->orderBy('created_at', 'desc')
                ->with('qrcode')
                ->with('visited')
                ->paginate($page);

            $limit = AppHelper::limit_checker('shortlinks', $links->count());

            return Inertia::render('ShortLinks/Show', compact('links', 'limit'));
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }
    // -------------------------------------------------


    // -------------------------------------------------
    // Creating a new short-link
    function create(Request $req)
    {
        $user = auth()->user();
        $current = Link::where('user_id', $user->id)->where('link_type', 'shortlink')->count();
        $limit = AppHelper::limit_checker('shortlinks', $current);
        if ($limit) {
            return back()->with("error", $limit);
        }

        $req->validate([
            'link_name' => ['required', 'string', 'min:5', 'max:255', new XSSPurifier],
            'external_url' => ['required', 'min:10', 'max:255', 'url', new XSSPurifier],
        ]);

        if ($req->link_slug) {
            $req->validate([
                'link_slug' => [
                    'string',
                    'min:8',
                    'max:50',
                    new XSSPurifier,
                    new CheckLinkName,
                    Rule::unique('links', 'url_name')->where(function ($query) use ($req) {
                        return $query->where('url_name', $req->link_slug);
                    }),
                ],
            ]);
        }

        try {
            $short_link = "";
            if ($req->link_slug) {
                $short_link = $req->link_slug;
            } else {
                $link_key = rand(10000000, 90000000);
                $short_link = base_convert($link_key, 10, 36);
            }

            $link = new Link;
            $link->user_id = $user->id;
            $link->link_name = $req->link_name;
            $link->link_type = $req->link_type;
            $link->url_name = $short_link;
            $link->external_url = $req->external_url;
            $link->save();

            return back()->with('success', 'Short Link created successfully');
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }
    //--------------------------------------------------


    //----------------------------------------------------
    // Bio-link name or username updating
    public function update(Request $req, $id)
    {
        $req->validate([
            'link_name' => ['required', 'string', 'min:5', 'max:255', new XSSPurifier],
            'external_url' => ['required', 'min:10', 'max:255', 'url', new XSSPurifier],
        ]);

        try {
            $link = Link::find($id);
            $link->link_name = $req->link_name;
            $link->external_url = $req->external_url;
            $link->save();

            return response(['success' => 'Short Link updated successfully', 'link' => $link]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //----------------------------------------------
    // Delete a bio-link
    public function delete($id)
    {
        try {
            $link = Link::find($id);
            LinkItem::where('item_link', $link->url_name)->delete();
            if ($link->qrcode_id) {
                QRCode::find($link->qrcode_id)->delete();
            }
            $link->delete();

            return back()->with('success', 'Link deleted successfully');
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }
    //--------------------------------------------------


    //--------------------------------------------------
    // Bio-link analytics for tracking bio-link
    public function analytics($id)
    {
        try {
            $languages = Language::get();
            $analytics = ShetabitVisit::where('link_id', $id)->get();

            return Inertia::render('LinkAnalytics', compact('analytics', 'languages'));
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }
    //--------------------------------------------------


    //--------------------------------------------------
    // Searching of short links
    public function search(Request $request)
    {
        try {
            $user = auth()->user();
            $query = $request->value;
            $page = $request->per_page ? intval($request->per_page) : 10;

            $baseQuery = Link::where('link_type', 'shortlink')
                ->where('link_name', 'LIKE', '%' . $query . '%')
                ->orderBy('created_at', 'desc')
                ->with('qrcode')
                ->with('visited')
                ->paginate($page);

            if ($user->role !== 'admin') {
                $baseQuery->where('user_id', $user->id);
            }

            return $baseQuery;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    // Export shortlinks list
    public function export()
    {
        $shortlinks = Link::where('link_type', 'shortlink')->get();
        $columns = Schema::getColumnListing((new Link())->getTable());
        $headers = AppHelper::exportToCSV($shortlinks, $columns, 'shortlinks');

        return Response::make('', 200, $headers);
    }
}
