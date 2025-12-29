<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Collection;
use App\Models\User;
use App\Models\Vehicle;
use App\Models\Customer;
use App\Models\DumpHistory;
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

        // Handle AJAX request for all data (filtering done in JavaScript)
        if ($request->ajax() && $request->has('get_all_data')) {
            // Get all collection data grouped by date (last 12 months)
            $startDate = Carbon::today()->subMonths(12)->startOfMonth();
            $endDate = Carbon::today()->endOfDay();
            
            $collections = Collection::where('company_id', $companyId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int)$item->count];
                });
            // Get all dump history and collection counts grouped by date
            $dumpHistories = DumpHistory::where('company_id', $companyId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int)$item->count];
                });
            
            $collectionCounts = Collection::where('company_id', $companyId)
                ->whereBetween('created_at', [$startDate, $endDate])
                ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int)$item->count];
                });
            
            return response()->json([
                'collections' => $collections,
                'dumpHistories' => $dumpHistories,
                'collectionCounts' => $collectionCounts
            ]);
        }

        $totalEmployes = User::where('company_id', $companyId)->count();
        $totalVehicles = Vehicle::where('company_id', $companyId)->count();
        $totalCustomers = Customer::where('company_id', $companyId)->count();

        $today = Carbon::today();
        
        // Summary totals: Show current month
        $monthStartDate = $today->copy()->startOfMonth()->startOfDay();
        $monthEndDate = $today->copy()->endOfMonth()->endOfDay();
        
        $totalDumpHistories = DumpHistory::where('company_id', $companyId)
            ->whereBetween('created_at', [$monthStartDate, $monthEndDate])
            ->count();
        
        $totalCollections = Collection::where('company_id', $companyId)
            ->whereBetween('created_at', [$monthStartDate, $monthEndDate])
            ->count();
        
        // Chart data: Default to last 15 days
        $chartEndDate = $today->copy()->endOfDay();
        $chartStartDate = $today->copy()->subDays(14)->startOfDay(); // 15 days total (today + 14 previous days)
        
        // Get collection data for chart (last 15 days)
        $collections = Collection::where('company_id', $companyId)
            ->whereBetween('created_at', [$chartStartDate, $chartEndDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
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
            $chartData[] = $dayData ? (int)$dayData->count : 0;
            
            $currentDate->addDay();
        }
        
        // Pass current month for JavaScript
        $currentMonth = $today->format('Y-m');
        
        return view('dashboard', compact('totalCollections', 'totalEmployes', 'totalVehicles','totalCustomers', 'totalDumpHistories', 'chartData', 'chartCategories', 'currentMonth'));
    }
}