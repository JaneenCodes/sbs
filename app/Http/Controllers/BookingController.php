<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Validator;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = [
            'bookings' => Booking::latest()->get(),
        ];

        return view('bookings.index', $data);
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
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $code = $this->randomId();
        $booking = Booking::create([
            'code' => $code,
            'name' => $data['name'],          
            'type' => $data['type'],
            'description' => $data['description'],
        ]);

        return redirect()->route('bookings', $booking)->with('success', 'Booking Created Successfully');
    }

    private function randomId()
    {
        $code = Str::random(4);
        $validator = Validator::make(['code'=>$code],['code'=>'unique:bookings,code']);

        if($validator->fails()){
            return $this->randomId();
        }

        return $code;
    }

    /**
     * Display the specified resource.
     */
    public function show(Booking $booking)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Booking $booking)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Booking $booking)
    {
        $data = $request->validate([
            'name' => 'required',
            'type' => 'required',
            'description' => 'required',
        ]);

        $booking->update([
            'name' => $data['name'],          
            'type' => $data['type'],
            'description' => $data['description'],
        ]);

        return redirect()->route('bookings', $booking)->with('success', 'Booking Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Booking $booking)
    {
        $booking->delete();
        return redirect()->route('bookings')->with('success', 'Booking deleted successfully!');
    }
}