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

        // Handle AJAX request for filtered dump history and collection counts
        if ($request->ajax()) {
            // Handle collection chart data request
            if ($request->has('collection_chart')) {
                $collectionQuery = Collection::where('company_id', $companyId);
                $today = Carbon::today();
                
                if ($request->has('date')) {
                    // Filter by specific date
                    $date = Carbon::parse($request->date);
                    $startDate = $date->copy()->startOfDay();
                    $endDate = $date->copy()->endOfDay();
                    $collectionQuery->whereBetween('created_at', [$startDate, $endDate]);
                } elseif ($request->has('month')) {
                    // Filter by month (e.g., "2024-12")
                    $month = Carbon::parse($request->month . '-01');
                    $startDate = $month->copy()->startOfMonth();
                    $endDate = $month->copy()->endOfMonth();
                    $collectionQuery->whereBetween('created_at', [$startDate, $endDate]);
                } else {
                    // Default: Last 30 days
                    $startDate = $today->copy()->subDays(29)->startOfDay();
                    $endDate = $today->copy()->endOfDay();
                    $collectionQuery->whereBetween('created_at', [$startDate, $endDate]);
                }
                
                // Get daily collection counts
                $collections = $collectionQuery->selectRaw('DATE(created_at) as date, COUNT(*) as count')
                    ->groupBy('date')
                    ->orderBy('date', 'asc')
                    ->get();
                
                // Generate chart data for the date range
                $chartData = [];
                $chartCategories = [];
                $currentDate = $startDate->copy();
                
                while ($currentDate <= $endDate) {
                    $dateStr = $currentDate->format('Y-m-d');
                    $chartCategories[] = $currentDate->format('d M');
                    
                    $dayData = $collections->firstWhere('date', $dateStr);
                    $chartData[] = $dayData ? (int)$dayData->count : 0;
                    
                    $currentDate->addDay();
                }
                
                return response()->json([
                    'series' => $chartData,
                    'categories' => $chartCategories
                ]);
            }
            
            // Handle dump history and collection count filter
            if ($request->has('date') || $request->has('month')) {
                $dumpQuery = DumpHistory::where('company_id', $companyId);
                $collectionQuery = Collection::where('company_id', $companyId);
                
                if ($request->has('date')) {
                    // Filter by specific date
                    $date = Carbon::parse($request->date);
                    $dumpQuery->whereDate('created_at', $date->format('Y-m-d'));
                    $collectionQuery->whereDate('created_at', $date->format('Y-m-d'));
                } elseif ($request->has('month')) {
                    // Filter by month (e.g., "2024-12")
                    $month = Carbon::parse($request->month . '-01');
                    $startDate = $month->copy()->startOfMonth();
                    $endDate = $month->copy()->endOfMonth();
                    $dumpQuery->whereBetween('created_at', [$startDate, $endDate]);
                    $collectionQuery->whereBetween('created_at', [$startDate, $endDate]);
                }
                
                $dumpCount = $dumpQuery->count();
                $collectionCount = $collectionQuery->count();
                
                return response()->json([
                    'dumpCount' => $dumpCount,
                    'collectionCount' => $collectionCount
                ]);
            }
        }

        $totalEmployes = User::where('company_id', $companyId)->count();
        $totalVehicles = Vehicle::where('company_id', $companyId)->count();
        $totalCustomers = Customer::where('company_id', $companyId)->count();

        // Default: Show last 30 days (today and 29 days before)
        $today = Carbon::today();
        $startDate = $today->copy()->subDays(29)->startOfDay();
        $endDate = $today->copy()->endOfDay();
        
        $totalDumpHistories = DumpHistory::where('company_id', $companyId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        $totalCollections = Collection::where('company_id', $companyId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->count();
        
        // Get collection data for chart (last 30 days)
        $collections = Collection::where('company_id', $companyId)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->selectRaw('DATE(created_at) as date, COUNT(*) as count')
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get();
        
        // Generate chart data for last 30 days
        $chartData = [];
        $chartCategories = [];
        $currentDate = $startDate->copy();
        
        while ($currentDate <= $endDate) {
            $dateStr = $currentDate->format('Y-m-d');
            $chartCategories[] = $currentDate->format('d M');
            
            $dayData = $collections->firstWhere('date', $dateStr);
            $chartData[] = $dayData ? (int)$dayData->count : 0;
            
            $currentDate->addDay();
        }
        
        return view('dashboard', compact('totalCollections', 'totalEmployes', 'totalVehicles','totalCustomers', 'totalDumpHistories', 'chartData', 'chartCategories'));
    }
}
