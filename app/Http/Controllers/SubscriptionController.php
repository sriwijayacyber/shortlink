<?php

namespace App\Http\Controllers;

use App\Helpers\AppHelper;
use Inertia\Inertia;
use Illuminate\Http\Request;
use App\Models\PricingPlan;
use App\Models\Subscription;
use App\Models\PaymentGateway;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Response;

class SubscriptionController extends Controller
{
    // -----------------------------------------
    // Getting the billing information
    public function billing(Request $req, $id)
    {
        try {
            $type = $req->query()['type'];
            if ($type && $type == 'monthly' || $type == 'yearly') {
                $user = auth()->user();
                $plan = PricingPlan::where('id', $id)->first();
                $methods = PaymentGateway::all();

                return view('pages.checkout', compact('plan', 'type', 'methods'));
            } else {
                return redirect()->route('plan')->with('error', 'Query param is not found or invalid.');
            }
        } catch (\Throwable $th) {
            return redirect()->route('plan')->with('error', $th->getMessage());
        }
    }
    // -----------------------------------------


    // -----------------------------------------
    // View payment history only for super admin
    public function subscriptions(Request $req)
    {
        try {
            $page = $req->per_page ? intval($req->per_page) : 10;
            $subscriptions = Subscription::orderBy('created_at', 'desc')->paginate($page);

            return  Inertia::render('Admin/Subscriptions', compact('subscriptions'));
        } catch (\Throwable $th) {
            return back()->with('error', $th->getMessage());
        }
    }
    // -----------------------------------------


    // -----------------------------------------
    // View payment history only for super admin
    public function subscriptions_search(Request $req)
    {
        try {
            $query = $req->value;
            $page = $req->per_page ? intval($req->per_page) : 10;

            $users = Subscription::where(function ($user) use ($query) {
                $user->where('method', 'LIKE', '%' . $query . '%')
                    ->orWhere('billing', 'LIKE', '%' . $query . '%')
                    ->orWhere('total_price', 'LIKE', '%' . $query . '%');
            })
                ->orderBy('created_at', 'desc')
                ->paginate($page);


            return $users;
        } catch (\Throwable $th) {
            return response()->json(['error' => $th->getMessage()]);
        }
    }
    // -----------------------------------------


    // Export testimonials list
    public function export_data()
    {
        $testimonials = Subscription::all();
        $columns = Schema::getColumnListing((new Subscription())->getTable());
        $headers = AppHelper::exportToCSV($testimonials, $columns, 'testimonials');

        return Response::make('', 200, $headers);
    }
}
