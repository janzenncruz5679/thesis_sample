<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use App\Models\Doctor;
use Notification;
use App\Notifications\SendEmailNotif;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class AdminController extends Controller
{
    public function addview()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                return view('admin.add_doctor');
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('home');
        }
    }

    public function upload(Request $request)
    {
        //Doctor-->app model
        $doctor = new Doctor;
        //getting the image file
        $image = $request->file;

        //declare another variable using time function
        //so when we upload image the image will have different name depends on time function
        $imagename = time() . '.' . $image->getClientOriginalExtension();

        //move the file inside the public folder doctor image
        //if the folder is not created, whenenever you up a image
        //the doctor image will saved into $imagename
        $request->file->move('doctorimage', $imagename);

        //sending the doctor image in database
        $doctor->image = $imagename;

        //$doctor->name--->the name came from the column in doctors table
        //$request->name--->the name came from add_doctor.blade in the form
        $doctor->name = $request->name;
        $doctor->phone = $request->number;
        $doctor->room_num = $request->room_num;
        $doctor->speciality = $request->speciality;

        $doctor->save();
        return redirect()->back()->with('message', 'Doctor Added Successfully');
    }

    public function showappointment()
    {
        if (Auth::id()) {
            if (Auth::user()->usertype == 1) {
                $appointment_data = Appointment::all();
                return view('admin.showappointment', compact('appointment_data'));
            } else {
                return redirect()->back();
            }
        } else {
            return redirect('home');
        }
    }

    public function approve($id)
    {
        //find the specific row only
        $approved_data = Appointment::find($id);

        //change the status data from in progress to approve then save it
        $approved_data->status = 'approved';
        $approved_data->save();

        return redirect()->back();
    }

    public function cancel($id)
    {
        //find the specific row only
        $approved_data = Appointment::find($id);

        //change the status data from in progress to approve then save it
        $approved_data->status = 'cancel';
        $approved_data->save();

        return redirect()->back();
    }

    public function showdoctor()
    {
        $data_doctor = doctor::all();
        return view('admin.showdoctor', compact('data_doctor'));
    }

    public function deletedoctor($id)
    {
        $data_doctor = doctor::find($id);
        $data_doctor->delete();

        return redirect()->back();
    }

    public function updatedoctor($id)
    {
        $update_data_doctor = doctor::find($id);
        return view('admin.updatedoctor', compact('update_data_doctor'));
    }

    public function editdoctor(Request $request, $id)
    {
        $edit_data_doctor = doctor::find($id);

        //update doctor data in db
        $edit_data_doctor->name = $request->name;
        $edit_data_doctor->phone = $request->phone;
        $edit_data_doctor->speciality = $request->speciality;
        $edit_data_doctor->room_num = $request->room;

        //add image to doctors table
        $image_update = $request->file;
        //only execute when the admin will upload the image
        if ($image_update) {
            $imagename = time() . '.' . $image_update->getClientOriginalExtension();

            //upload image in doctors table then throw it at designated folder
            $request->file->move('doctorimage', $imagename);
            $edit_data_doctor->image = $imagename;
        }
        $edit_data_doctor->save();

        return redirect()->back()->with('message', "Doctor updated successfully");
    }

    public function email_patient($id)
    {
        $email_data = appointment::find($id);
        return view('admin.email_patient', compact('email_data'));
    }

    public function send_email(Request $request, $id)
    {
        $send_email_data = appointment::find($id);
        $details = [
            //from sendemailnotif to admin controller
            'greeting' => $request->greeting,
            'body' => $request->body,
            'action_text' => $request->action_text,
            'action_url' => $request->action_url,
            'end_part' => $request->end_part,
        ];

        Notification::send($send_email_data, new SendEmailNotif($details));

        return redirect()->back()->with('message', "Email is sent successfully");
    }
}