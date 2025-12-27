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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $companyId = Auth::user()->company_id;

        $totalCollections = Collection::where('company_id', $companyId)->count();
        $totalEmployes = User::where('company_id', $companyId)->count();
        $totalVehicles = Vehicle::where('company_id', $companyId)->count();
        $totalCustomers = Customer::where('company_id', $companyId)->count();

        $totalDumpHistories = DumpHistory::where('company_id', $companyId)->count();
        
        return view('dashboard', compact('totalCollections', 'totalEmployes', 'totalVehicles','totalCustomers', 'totalDumpHistories'));
    }
}
