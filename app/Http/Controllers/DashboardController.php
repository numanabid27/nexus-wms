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
        // $name = Auth::user()->name;
        // dd($name);
        
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
                    return [$item->date => (int)$item->count];
                });
            // Get all dump history and collection counts grouped by date
            $dumpHistories = DumpHistory::where('company_id', $companyId)
                ->whereBetween('dump_date', [$startDate, $endDate])
                ->selectRaw('DATE(dump_date) as date, COUNT(*) as count')
                ->groupBy('date')
                ->orderBy('date', 'asc')
                ->get()
                ->mapWithKeys(function ($item) {
                    return [$item->date => (int)$item->count];
                });
            
            $collectionCounts = Collection::where('company_id', $companyId)
                ->whereBetween('pickup_date', [$startDate, $endDate])
                ->selectRaw('DATE(pickup_date) as date, COUNT(*) as count')
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
        // dd($totalEmployes);
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
            $chartData[] = $dayData ? (int)$dayData->count : 0;
            
            $currentDate->addDay();
        }
        
        // Pass current month for JavaScript
        $currentMonth = $today->format('Y-m');
        
        // Top drivers
        $topDrivers = User::select('users.id', 'users.name', 'users.image_guid')
            ->selectRaw('COUNT(collections.id) as collection_count')
            ->join('collections', 'collections.driver_id', '=', 'users.id')
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.company_id', $companyId)
            ->where('users.is_deleted', 0)
            ->where('collections.company_id', $companyId)
            ->whereNotNull('collections.driver_id')
            ->where('roles.name', 'Driver')
            ->where('model_has_roles.model_type', User::class)
            ->groupBy('users.id', 'users.name', 'users.image_guid')
            ->having('collection_count', '>', 0)
            ->orderByDesc('collection_count')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image_guid' => $user->image_guid,
                    'count' => (int)$user->collection_count
                ];
            })
            ->values();
            
        // Top drivers
        $topHelpers = User::select('users.id', 'users.name', 'users.image_guid')
            ->selectRaw('COUNT(collections.id) as collection_count')
            ->join('collections', function($join) {
                $join->whereNotNull('collections.helper_ids')
                    ->whereRaw('FIND_IN_SET(users.id, collections.helper_ids)');
            })
            ->join('model_has_roles', 'model_has_roles.model_id', '=', 'users.id')
            ->join('roles', 'roles.id', '=', 'model_has_roles.role_id')
            ->where('users.company_id', $companyId)
            ->where('users.is_deleted', 0)
            ->where('collections.company_id', $companyId)
            ->where('roles.name', 'Helper')
            ->where('model_has_roles.model_type', User::class)
            ->groupBy('users.id', 'users.name', 'users.image_guid')
            ->having('collection_count', '>', 0)
            ->orderByDesc('collection_count')
            ->limit(10)
            ->get()
            ->map(function ($user) {
                return [
                    'id' => $user->id,
                    'name' => $user->name,
                    'image_guid' => $user->image_guid,
                    'count' => (int)$user->collection_count
                ];
            })
            ->values();

        
        return view('dashboard', compact('totalCollections', 'totalEmployes', 'totalVehicles','totalCustomers', 'totalDumpHistories', 'chartData', 'chartCategories', 'currentMonth', 'topDrivers', 'topHelpers'));
    }
}