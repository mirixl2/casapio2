<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Reservation;


class ReservationController extends Controller
{
    /**
     * Check if current user is admin.
     *
     * @return Boolean true/false
     */
    private function GetIsAdmin()
    {
        return Auth::id() && Auth::user()->usertype == "1" ? true : false;
    }

    /**
     * Display a listing of the reservation entry.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $isAdmin = $this->GetIsAdmin();
        $data = $isAdmin === true ? reservation::all() : null;
        $user = Auth::id() ? Auth::user() : null;
        return view("admin.pages.reservation", compact("data", "isAdmin", "user"));
    }

    /**
     * Store a newly created reservation entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = new reservation;
        $data->name = $request->name;
        $data->phone_number = $request->phone;
        $data->date = $request->date;
        $data->time = $request->time;
        $data->person = $request->person;

        $data->save();
        
        return redirect()->back()->with('msg', 'Reservation made successfully');
    }

    /**
     * Show the form for editing the specified reservation entry.
     *
     * @param  $reservation->id
     * @return \Illuminate\Http\Response
     */
    public function edit($reservation)
    {
        $data = reservation::findOrFail($reservation);
        $user = Auth::id() ? Auth::user() : null;
        $isAdmin = $this->GetIsAdmin();
        return view("admin.pages.editreservation", compact("data", "user", "isAdmin"));
    }

    /**
     * Update the specified reservation entry in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $reservation->id
     * @return \Illuminate\Http\Response
     */
    public function update($reservation, Request $request)
    {
        $isAdmin = $this->GetIsAdmin();
        if($isAdmin === true){
            $data = reservation::findOrFail($reservation);

            $data->name = $request->name;
            $data->phone_number = $request->phone;
            $data->date = $request->date;
            $data->time = $request->time;
            $data->person = $request->person;

            $data->save();

            return redirect()->route('reservation.index')->with('msg', 'Reservation entry edited');
        }
        return redirect()->route('reservation.index')->with('msg', "Can't edit reservation entry" );
    }
}
