<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Appointment;
use DB;

class ChartsController extends Controller
{
    public function appointments()
    {
        $monthlyCounts = Appointment::select(
            DB::raw('MONTH(created_at) as month'), 
            DB::raw('COUNT(1) as count')
        )->groupBy('month')->get()->toArray();
        // [ ['month'=>11, 'count'=>3] ]
        // [0, 0, 0, 0, ..., 3, 0]

        $counts = array_fill(0, 12, 0);

        foreach($monthlyCounts as $monthlyCount) {
            $index = $monthlyCount['month'] - 1;
            $counts[$index] = $monthlyCount['count'];
        }

        return view('charts.appointments', compact('counts'));
    }
}
