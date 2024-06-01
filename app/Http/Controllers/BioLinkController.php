<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use App\Models\Link;
use App\Models\Theme;
use App\Models\QRCode;
use App\Models\LinkItem;
use App\Rules\XSSPurifier;
use App\Helpers\AppHelper;
use App\Models\SocialLinks;
use Illuminate\Http\Request;
use App\Models\CustomTheme;
use App\Models\PricingPlan;
use App\Models\ShetabitVisit;
use App\Rules\CheckLinkName;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Schema;
use Stevebauman\Location\Facades\Location;
use Intervention\Image\ImageManagerStatic as Image;

class BioLinkController extends Controller
{
    // Getting the total bio-links of users
    public function index(Request $req)
    {
        try {
            $linkLimit = 0;
            $user = AppHelper::user();
            $SA = $user->hasRole('SUPER-ADMIN');
            $plan = PricingPlan::where('id', $user->pricing_plan_id)->first();
            $page = $req->per_page ? intval($req->per_page) : 10;

            $links = Link::when(!$SA, function ($query) use ($user) {
                return $query->where('user_id', $user->id);
            })
                ->where('link_type', 'biolink')
                ->orderBy('created_at', 'desc')
                ->with('qrcode')
                ->with('visited')
                ->paginate($page);

            $limit = AppHelper::limit_checker('biolinks', $links->count());

            return Inertia::render('BioLinks/Show', compact('links', 'limit'));
        } catch (\Throwable $th) {
            return back()->with("error", $th->getMessage());
        }
    }
    // -------------------------------------------------


    // -------------------------------------------------
    // Creating a new bio-link
    function create(Request $req)
    {
        $user = auth()->user();
        $current = Link::where('user_id', $user->id)->where('link_type', 'biolink')->count();
        $limit = AppHelper::limit_checker('biolinks', $current);
        if ($limit) {
            return back()->with("error", $limit);
        }

        $req->validate([
            'link_name' => ['required', 'string', 'min:5', 'max:50', new XSSPurifier],
            'url_name' => ['required', 'string', 'unique:links', 'min:5', 'max:50', new XSSPurifier, new CheckLinkName],
        ]);

        try {
            $theme = Theme::get()->first();
            $trimUrl = trim(str_replace(" ", "", $req->url_name));
            $urlName = preg_replace("/\s+/", "", strtolower($trimUrl));

            $link = new Link;
            $link->user_id = $user->id;
            $link->link_name = $req->link_name;
            $link->url_name = $urlName;
            $link->theme_id = $theme->id;
            $link->save();

            return back()->with('success', 'Link created successfully');
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
            'link_name' => ['required', 'string', 'min:5', 'max:50', new XSSPurifier]
        ]);
        if ($req->new_url) {
            $req->validate([
                'url_name' => ['required', 'string', 'unique:links', 'min:5', 'max:50', new XSSPurifier, new CheckLinkName]
            ]);
        }

        try {
            $link = Link::find($id);
            $link->link_name = $req->link_name;
            if ($req->new_url) $link->url_name = $req->url_name;
            $link->save();

            return response(['success' => 'Bio Link updated successfully', 'link' => $link]);
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


    //--------------------------------------------------------
    // Getting the single bio-link to to customize
    function customize($id)
    {
        $user = auth()->user();
        $themes = Theme::all();
        $socialLinks = SocialLinks::all();
        $itemLastPosition = LinkItem::where('link_id', $id)->max('item_position');

        $link = AppHelper::get_link($id);
        if (!$link) back()->with("error", "Link not found.");

        return Inertia::render(
            'BioLinks/AddItem',
            compact('link', 'socialLinks', 'themes', 'itemLastPosition')
        );
    }
    //--------------------------------------------------------


    //----------------------------------------------------
    // Socials links updating of bio-link
    public function add_socials(Request $req, $id)
    {
        try {
            $link = Link::where('id', $id)
                ->with('items')
                ->with('theme')
                ->with('custom_theme')
                ->first();
            $link->socials = $req->socials;
            $link->social_color = $req->social_color;
            $link->save();

            $updatedLink = AppHelper::get_link($id);
            return response($updatedLink);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //----------------------------------------------------
    //Bio-link profile updating
    public function update_profile(Request $req, $id)
    {
        try {
            $rules = ['link_bio' => 'max:200'];
            $messages = ['link_bio.max' => 'Bio description length must be 1 to 200 characters'];

            $this->validate($req, $rules, $messages,);
            $link = Link::where('id', $id)->with('theme')->with('custom_theme')->first();
            $thumbnail = $req->thumbnail;

            if ($thumbnail != 'null') {
                $rules = ['thumbnail' => 'image|mimes:jpg,png,jpeg,svg|max:1024'];
                $messages = [
                    'thumbnail.max' => 'Image size will be 1MB',
                    'thumbnail.image' => 'Allow only jpg,png,jpeg,svg type image',
                ];

                $this->validate($req, $rules, $messages,);
                File::delete($link->thumbnail);
                $imgUrl = AppHelper::image_uploader($thumbnail);

                $link->link_name = $req->link_name;
                $link->short_bio = $req->short_bio;
                $link->thumbnail = $imgUrl;
                $link->save();
            } else {
                $link->link_name = $req->link_name;
                $link->short_bio = $req->short_bio;
                $link->save();
            }

            $updatedLink = AppHelper::get_link($id);
            return response(['success' => true, 'link' => $updatedLink]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //----------------------------------------------------
    // Bio-link name or username updating
    public function update_logo(Request $req, $id)
    {
        try {
            $link = Link::where('id', $id)->with('theme')->with('custom_theme')->first();;
            if ($link->branding) File::delete($link->branding);
            $imgUrl = AppHelper::image_uploader($req->branding);
            $link->branding = $imgUrl;
            $link->save();

            $updatedLink = AppHelper::get_link($id);
            return response(['success' => true, 'link' => $updatedLink]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //----------------------------------------------
    // Changing the current theme of bio-link
    function update_theme($themeId, $linkId)
    {
        try {
            $link = Link::find($linkId);
            $link->custom_theme_active = FALSE;
            $link->theme_id = (int) $themeId;
            $link->save();

            $updatedLink = AppHelper::get_link($linkId);
            return response(['success' => true, 'link' => $updatedLink]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //----------------------------------------------
    // Creating custom theme for user bio-link
    function custom_theme_create(Request $req, $id)
    {
        try {
            $theme = new CustomTheme();
            $theme->link_id = $id;
            $theme->background = $req->background;
            $theme->background_type = $req->background_type;
            $theme->bg_color = $req->bg_color;
            $theme->text_color = $req->text_color;
            $theme->btn_type = $req->btn_type;
            $theme->btn_transparent = $req->btn_transparent;
            $theme->btn_radius = $req->btn_radius;
            $theme->btn_bg_color = $req->btn_bg_color;
            $theme->btn_text_color = $req->btn_text_color;
            $theme->font_family = $req->font_family;
            $theme->save();

            $link = Link::find($id);
            $link->custom_theme_active = TRUE;
            $link->custom_theme_id = $theme->id;
            $link->save();

            $updatedLink = AppHelper::get_link($id);
            return response(['success' => true, 'link' => $updatedLink]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //----------------------------------------------
    // Activating the user custom theme for bio-link
    function custom_theme_active($id)
    {
        try {
            $link = Link::find($id);
            $link->custom_theme_active = TRUE;
            $link->save();

            $updatedLink = AppHelper::get_link($id);
            return response(['success' => true, 'link' => $updatedLink]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
        }
    }
    //--------------------------------------------------


    //-------------------------------------------
    // Updating the user custom theme
    function custom_theme_update(Request $req, $themeId, $linkId)
    {
        try {
            $theme = CustomTheme::find($themeId);
            switch ($req->type) {
                case 'bg_color':
                    $theme->background = "background-color: $req->bg_color";
                    $theme->background_type = "color";
                    $theme->bg_color = $req->bg_color;
                    break;

                case 'bg_image':
                    $rules = [
                        'bg_image' => 'image|mimes:jpg,png,jpeg,svg|max:5120',
                    ];
                    $messages = [
                        'bg_image.image' => 'Allow only jpg,png,jpeg,svg type image',
                        'bg_image.max' => 'Image size will be 5MB',
                    ];

                    $this->validate($req, $rules, $messages,);
                    if ($theme->bg_image) File::delete($theme->bg_image);

                    $location = public_path('/upload/');
                    $image = Image::make($req->bg_image);
                    $image->save($location . time() . $req->bg_image->getClientOriginalName());
                    $imgUrl = 'upload/' . $image->filename . '.' . $image->extension;

                    $theme->background = "background-image: url('/$imgUrl')";
                    $theme->background_type = "image";
                    $theme->bg_image = $imgUrl;
                    break;

                case 'text_color':
                    $theme->text_color = $req->text_color;
                    break;

                case 'button':
                    $theme->btn_type = $req->btn_type;
                    $theme->btn_transparent = $req->btn_transparent;
                    $theme->btn_radius = $req->btn_radius;
                    break;

                case 'btn_bg_color':
                    $theme->btn_bg_color = $req->btn_bg_color;
                    break;

                case 'btn_text_color':
                    $theme->btn_text_color = $req->btn_text_color;
                    break;

                case 'font_family':
                    $theme->font_family = $req->font_family;
                    break;

                default:
                    break;
            }
            $theme->save();

            $updated_link = AppHelper::get_link($linkId);
            return response(['result' => $updated_link]);
        } catch (\Throwable $th) {
            return response(['error' => $th->getMessage()]);
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

            $baseQuery = Link::where('link_type', 'biolink')
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
    //----------------------------------------------


    //----------------------------------------------
    // Access the main bio-link page
    function bioLinkView(Request $req, $linkName)
    {
        try {
            $link = Link::where('url_name', $linkName)
                ->with('items')
                ->with('theme')
                ->with('custom_theme')
                ->first();
            if ($link) {
                $model = new ShetabitVisit;
                $result = $req->visitor()->visit($model);

                // when app on the live server then ip will be => $req->ip();
                // $location = Location::get("103.146.2.177");
                $location = Location::get($req->ip());

                ShetabitVisit::where('id', $result->id)->update([
                    'ip' => json_encode($location),
                    'link_id' => $link->id,
                ]);

                if ($link->link_type == 'shortlink') {
                    return redirect()->to(url($link->external_url));
                } else {
                    return Inertia::render('BioLinks/View', compact('link'));
                }
            } else {
                abort(404);
            }
        } catch (\Throwable $th) {
            abort(404);
        }
    }
    //--------------------------------------------------


    // Export biolinks list
    public function export()
    {
        $biolinks = Link::where('link_type', 'biolink')->get();
        $columns = Schema::getColumnListing((new Link())->getTable());
        $headers = AppHelper::exportToCSV($biolinks, $columns, 'biolinks');

        return Response::make('', 200, $headers);
    }
}
