<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointments::with('booking')
                                    ->where('status', '1') 
                                    ->whereHas('booking', function ($query) {
                                        $query->where('status', '1'); 
                                    })
                                    ->get();

        $data = [];

        foreach ($appointments as $appointment) {
            $data[] = [
                'title' => $appointment->booking->name,
                'start' => $appointment->borrowed_at,
                'end' => $appointment->returned_at,
            ];
        }

        return view('dashboard', ['data' => $data]);
    }
}


