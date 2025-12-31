<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\DumpHistory;
use App\Models\Billing;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Contracts\Support\Renderable|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        $companyId = Auth::user()->company_id;

        if ($request->ajax() && $request->has('get_all_data')) {
            // Get all collection data grouped by date (last 12 months)
            $startDate = Carbon::today()->subMonths(12)->startOfMonth();
            $endDate = Carbon::today()->endOfDay();

            $collections = Collection::where('company_id', $companyId)
                ->whereBetween('pickup_date', [$startDate, $endDate])
                ->selectRaw('DATE(pickup_date) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int) $item->count];
                });
            // Get all dump history and collection counts grouped by date
            $dumpHistories = DumpHistory::where('company_id', $companyId)
                ->whereBetween('dump_date', [$startDate, $endDate])
                ->selectRaw('DATE(dump_date) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int) $item->count];
                });

            $collectionCounts = Collection::where('company_id', $companyId)
                ->whereBetween('pickup_date', [$startDate, $endDate])
                ->selectRaw('DATE(pickup_date) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int) $item->count];
                });

            return response()->json([
                'collections' => $collections,
                'dumpHistories' => $dumpHistories,
                'collectionCounts' => $collectionCounts
            ]);
        }

        // Handle AJAX request for billing counts by date range
        if ($request->ajax() && $request->has('get_billing_counts')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            if ($startDate && $endDate) {
                $monthStartDate = Carbon::parse($startDate)->startOfDay();
                $monthEndDate = Carbon::parse($endDate)->endOfDay();
            } else {
                // Default to current month
                $today = Carbon::today();
                $monthStartDate = $today->copy()->startOfMonth()->startOfDay();
                $monthEndDate = $today->copy()->endOfMonth()->endOfDay();
            }

            $generatedBills = Billing::where('company_id', $companyId)
                ->where('invoice_generated', 0)
                ->whereBetween('generated_date', [$monthStartDate, $monthEndDate])
                ->count();

            $unpaidInvoices = Billing::where('company_id', $companyId)
                ->where('is_paid', 0)
                ->where('invoice_generated', 1)
                ->whereBetween('generated_date', [$monthStartDate, $monthEndDate])
                ->count();

            $paidInvoices = Billing::where('company_id', $companyId)
                ->where('is_paid', 1)
                ->where('invoice_generated', 1)
                ->whereBetween('generated_date', [$monthStartDate, $monthEndDate])
                ->count();

            return response()->json([
                'generatedBills' => $generatedBills,
                'unpaidInvoices' => $unpaidInvoices,
                'paidInvoices' => $paidInvoices
            ]);
        }

        // Handle AJAX request for driver collection/dumps chart data
        if ($request->ajax() && $request->has('get_driver_chart_data')) {
            $startDate = $request->input('start_date');
            $endDate = $request->input('end_date');
            
            if ($startDate && $endDate) {
                $chartStartDate = Carbon::parse($startDate)->startOfDay();
                $chartEndDate = Carbon::parse($endDate)->endOfDay();
            } else {
                // Default to current month
                $today = Carbon::today();
                $chartStartDate = $today->copy()->startOfMonth()->startOfDay();
                $chartEndDate = $today->copy()->endOfMonth()->endOfDay();
            }

            $bar_cart_data = User::withCount([
                    'collections_driver' => function ($q) use ($chartStartDate, $chartEndDate) {
                        $q->whereBetween('pickup_date', [$chartStartDate, $chartEndDate]);
                    }, 
                    'dumps_driver' => function ($q) use ($chartStartDate, $chartEndDate) {
                        $q->whereBetween('dump_date', [$chartStartDate, $chartEndDate]);
                    }
                ])
                ->whereHas('roles', function ($query) {
                    $query->where('name', 'Driver');
                })
                ->where('company_id', $companyId)
                ->where('is_deleted', 0)
                ->get();
                
            $bar_cart = [
                'drivers' => $bar_cart_data->pluck('name')->map(fn($n) => "\"{$n}\"")->implode(' , '),
                'collections' => $bar_cart_data->pluck('collections_driver_count')->implode(' , '),
                'dumps' => $bar_cart_data->pluck('dumps_driver_count')->implode(' , '),
            ];

            return response()->json($bar_cart);
        }

        $totalEmployes = User::where('company_id', $companyId)->count();
        $totalVehicles = Vehicle::where('company_id', $companyId)->count();
        $totalCustomers = Customer::where('company_id', $companyId)->count();
        $today = Carbon::today();

        // Summary totals: Show current month
        $monthStartDate = $today->copy()->startOfMonth()->startOfDay();
        $monthEndDate = $today->copy()->endOfMonth()->endOfDay();

        $totalDumpHistories = DumpHistory::where('company_id', $companyId)
            ->whereBetween('dump_date', [$monthStartDate, $monthEndDate])
            ->count();

        $totalCollections = Collection::where('company_id', $companyId)
            ->whereBetween('pickup_date', [$monthStartDate, $monthEndDate])
            ->count();

        // Chart data: Default to last 15 days
        $chartEndDate = $today->copy()->endOfDay();
        $chartStartDate = $today->copy()->subDays(14)->startOfDay(); // 15 days total (today + 14 previous days)

        // Get collection data for chart (last 15 days)
        $collections = Collection::where('company_id', $companyId)
            ->whereBetween('pickup_date', [$chartStartDate, $chartEndDate])
            ->selectRaw('DATE(pickup_date) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();

        // Generate chart data for last 15 days
        $chartData = [];
        $chartCategories = [];
        $currentDate = $chartStartDate->copy();

        while ($currentDate <= $chartEndDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $chartCategories[] = $currentDate->format('d M');

            $dayData = $collections->firstWhere('date', $dateStr);
            $chartData[] = $dayData ? (int) $dayData->count : 0;

            $currentDate->addDay();
        }

        // Pass current month for JavaScript
        $currentMonth = $today->format('Y-m');

        // top drivers
        $topDrivers = User::select('users.id', 'users.name', 'users.image_guid', DB::raw('count(collections.id) as count'))
            ->join('collections', 'users.id', '=', 'collections.driver_id')
            ->where('users.company_id', $companyId)
            ->where('users.is_deleted', 0)
            ->where('collections.company_id', $companyId)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Driver');
            })
            ->groupBy('users.id', 'users.name', 'users.image_guid')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        // top helpers
        $topHelpers = User::select('users.id', 'users.name', 'users.image_guid', DB::raw('count(collections.id) as count'))
            ->join('collections', function ($join) {
                $join->on('users.company_id', '=', 'collections.company_id')
                    ->whereRaw('FIND_IN_SET(users.id, collections.helper_ids)');
            })
            ->where('users.company_id', $companyId)
            ->where('users.is_deleted', 0)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Helper');
            })
            ->groupBy('users.id', 'users.name', 'users.image_guid')
            ->orderByDesc('count')
            ->limit(10)
            ->get();

        
        // billing summary
        $generatedBills = Billing::where('company_id', $companyId)
            ->where('invoice_generated', 0)
            ->whereBetween('generated_date', [$monthStartDate, $monthEndDate])
            ->count();

        $unpaidInvoices = Billing::where('company_id', $companyId)
            ->where('is_paid', 0)
            ->where('invoice_generated', 1)
            ->whereBetween('generated_date', [$monthStartDate, $monthEndDate])
            ->count();

        $paidInvoices = Billing::where('company_id', $companyId)
            ->where('is_paid', 1)
            ->where('invoice_generated', 1)
            ->whereBetween('generated_date', [$monthStartDate, $monthEndDate])
            ->count();
       

    

        return view('dashboard', compact('totalCollections', 'totalEmployes', 'totalVehicles', 'totalCustomers', 'totalDumpHistories', 'chartData', 'chartCategories', 'currentMonth', 'topDrivers', 'topHelpers', 'generatedBills', 'unpaidInvoices', 'paidInvoices'));
    }
}