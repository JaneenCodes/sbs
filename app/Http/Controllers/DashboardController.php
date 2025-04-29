<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $appointments = Appointments::with('booking')
                                    ->where('status', '1') //approved
                                    ->orwhere('status', '0') //pending
                                    ->get();

        $data = [];

        foreach ($appointments as $appointment) {
            $color = $appointment->status == '1' ? '#5fc212' : '#cdcf09'; // green for approved, yellow for pending

            $data[] = [
                'title' => $appointment->booking->name,
                'start' => $appointment->borrowed_at,
                'end' => $appointment->returned_at,
                'color' => $color,
            ];
        }

        return view('dashboard', ['data' => $data]);
    }
}