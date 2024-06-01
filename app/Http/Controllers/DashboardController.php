<?php

namespace App\Http\Controllers;

use App\Models\QRCode;
use App\Models\Link;
use App\Models\Project;
use App\Models\ShetabitVisit;
use Inertia\Inertia;

class DashboardController extends Controller
{
    public static function overview_counter($links, $analytics, $projects, $qrcodes) 
    {
        $overview = [
            [
                "icon"=>"fa-solid fa-link-simple",
                'title'=>"Total links", 
                "total"=>count($links)
            ],
            [
                "icon"=>"fa-regular fa-eye",
                'title'=>"Links Pageview", 
                "total"=>count($analytics)
            ],
            [
                "icon"=>"fa-solid fa-list-check",
                'title'=>"Total Projects", 
                "total"=>count($projects)
            ],
            [
                "icon"=>"fa-regular fa-qrcode",
                'title'=>"Total QR Codes", 
                "total"=>count($qrcodes)
            ],
        ];

        return $overview;
    }

    public static function visitors_counter($analytics) 
    {
        // Counting the total page visitor of 12 months
        $counter = [];
        foreach($analytics as $item){
            $month = $item->created_at->format('M');
            $year = $item->created_at->format('Y');
            if ($year == date("Y")) {
                array_push($counter, $month);
            }
        };
    
        $values = [];
        $result = array_count_values($counter);    
        $counting = ["Jan"=>0, "Feb"=>0, "Mar"=>0, "Apr"=>0, "May"=>0, "Jun"=>0, "Jul"=>0, "Aug"=>0, "Sep"=>0, "Oct"=>0, "Nov"=>0, "Dec"=>0];
        foreach ($result as $key => $value) {
            foreach ($counting as $k => $v) {
                if ($k == $key) {
                    $counting[$k] = $value;
                }
            }
        }
        foreach ($counting as $key => $value) {
            array_push($values, $value);
        }

        return $values;
    }

    public static function weekly_page_view($analytics) 
    {
        // Counting the weekly page view
        $weeklyPageView = [0, 0, 0, 0, 0, 0, 0];
        foreach($analytics as $item){
            $day = $item->created_at->format('d');
            $year = $item->created_at->format('Y');
            $month = $item->created_at->format('m');
            
            if ($year == date("Y") && $month == date("m")) {
                for ($i=6, $j=0; $i >= 0 ; $i--, $j++) { 
                    $d=strtotime("-{$i} Days");
                    $countDay = date("d", $d);
                    if ($countDay == $day) {
                        $weeklyPageView[$j]++;
                    }
                }
            }
        };

        return $weeklyPageView;
    }


    public function index() 
    {
        try {
            $user = auth()->user();
            $SA = $user->hasRole('SUPER-ADMIN');
            
            if ($SA) {
                $links = Link::all()->count();
                $qrcodes = QRCode::all()->count();
                $projects = Project::all()->count();
                $analytics = ShetabitVisit::all();

                $visitors = self::visitors_counter($analytics);
                $page_view = self::weekly_page_view($analytics);
                $analytics = $analytics->count();
            } else {
                $links = Link::where('user_id', $user->id)->get()->count();
                $qrcodes = QRCode::where('user_id', $user->id)->get()->count();
                $projects = Project::where('user_id', $user->id)->get()->count();
                $analytics = ShetabitVisit::where('visitor_id', $user->id)->get();

                $visitors = self::visitors_counter($analytics);
                $page_view = self::weekly_page_view($analytics);
                $analytics = $analytics->count();   
            }

            return Inertia::render(
                'Dashboard', 
                compact('qrcodes', 'links', 'analytics', 'projects', 'visitors', 'page_view')
            );
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
}
