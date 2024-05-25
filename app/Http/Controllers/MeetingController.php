<?php

namespace App\Http\Controllers;

use App\Models\Meeting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;


class MeetingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $meetings=Meeting::all();
        return response()->json($meetings);
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
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'appointment_date' => 'required|date_format:Y-m-d H:i:s',

        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        Meeting::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'appointment_date' => $request->appointment_date,
        ]);

        return response()->json(['message' => 'Appointment booked successfully'], 201);
 
    }

    public function unavailableDates()
    {
        $appointments = Meeting::all(['appointment_date']);
    
        $unavailableDates = [];
        foreach ($appointments as $appointment) {
            $date = Carbon::parse($appointment->appointment_date)->format('Y-m-d');
            $time = Carbon::parse($appointment->appointment_date)->format('H:i');
            if (!isset($unavailableDates[$date])) {
                $unavailableDates[$date] = [];
            }
            $unavailableDates[$date][] = $time;
        }
    
        return response()->json($unavailableDates);
    }

    /**
     * Display the specified resource.
     */
    public function show(Meeting $meeting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Meeting $meeting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Meeting $meeting)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Meeting $meeting)
    {
        //
    }
}
