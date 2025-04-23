<?php

namespace App\Http\Controllers;

use App\Models\Appointments;
use App\Models\Booking;
use Illuminate\Http\Request;

class AppointmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'appointments' => Appointments::all(),
        ];
        return view('appointments.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Booking $booking)
    {

        $data = $request->validate([
            'name' => 'required',
            'contact' => 'required',
            'address' => 'required',
            'borrowed_at' => 'required|date',
            'returned_at' => 'required|date|after:borrowed_at',
        ]);

        $appointments = Appointments::create([
            'booking_id' => $booking->id,
            'name' => $data['name'],
            'contact' => $data['contact'],
            'address' => $data['address'],
            'borrowed_at' => $data['borrowed_at'],
            'returned_at' => $data['returned_at'],
        ]);

        return response()->json(['success' => true, $appointments,]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Appointments $appointments)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Appointments $appointments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Appointments $appointments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Appointments $appointments)
    {
        //
    }
}
