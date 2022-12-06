<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Appointment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function redirect()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == '0') {
                $doctor = Doctor::all();
                return view('user.home', compact('doctor'));
            } else {
                return view('admin.home');
            }
        } else {
            return redirect()->back();
        }
    }


    public function index()
    {
        if (Auth::id()) {
            return redirect('home');
        } else {
            $doctor = Doctor::all();

            return view('user.home', compact('doctor'));
        }
    }

    public function appointment(Request $request)
    {
        $appointment = new Appointment;

        //the $appointment->name came from row the name of appointment table
        //the $request->name came from the input name in appointment.blade
        $appointment->name = $request->name;
        $appointment->email = $request->email;
        $appointment->phone = $request->number;
        $appointment->date = $request->date;
        $appointment->doctor = $request->doctor;
        $appointment->message = $request->message;
        $appointment->status = 'in progress';

        //if the user is logged in they will not provide another info in database
        if (Auth::user()) {
            $appointment->user_id = Auth::user()->id;
            $appointment->name = Auth::user()->name;
            $appointment->email = Auth::user()->email;
        }

        $appointment->save();
        return redirect()->back()->with('message', 'Appointment success');
    }

    public function myappointment()
    {
        if (Auth::user()) {
            if (Auth::user()->usertype == 0) {
                //get the user id in user table
                $userid = Auth::user()->id;

                //declare a variable to get the data from user table to appointment table
                $userappoint = appointment::where('user_id', $userid)->get();

                //return the data to myappointment view
                return view('user.myappointment', compact('userappoint',));
            }
        } else {
            //if not login redirected only to home screen, cannot access myappointment view
            return redirect()->back();
        }
    }

    public function cancelappointment($id)
    {
        $userid = appointment::find($id);
        $userid->delete();

        return redirect()->back();
    }
}