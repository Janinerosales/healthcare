<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Doctor;
use App\Models\Profile;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\PatientNotification;

class statusController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $appointments = Appointment::with('user', 'profile', 'doctor', 'prescription')->simplePaginate(5);

        $doctors = Doctor::get();
        // dd($appointments);

        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->isoFormat('MMMM DD, YYYY');
        }
        // dd($appointments);
        return view('Patient.Appointment.index', compact('appointments', 'doctors'));
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
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // dd($request->all());
        $doctorId = Profile::where('user_id', $request['doctor_id'])?->first()?->id;
        // dd($doctorId);
        $appointment = Appointment::findorFail($id);
        // dd(Doctor::all(), $appointment);
        // dd($appointment);


        if ($appointment->status == 'Approved') {
            $appointment->update([
                'status' => 'Pending',
            ]);

            $mytime = \Carbon\Carbon::now();

            Notification::create([
                'day' => $mytime->format('h:i:s A'),
                'message' => 'Rejected Appointment',
            ]);
            PatientNotification::create([
                'patient_id' => $appointment->profile_id,
                'day' => $mytime->format('h:i:s A'),
                'message' => 'Your Appointment Has Been Rejected',
            ]);
            $appointment->save();

            return redirect()->back()->with('rejected', 'success');
        } else {
            $appointment->update([
                'doctor_id' => $doctorId,
                'status' => 'Approved',
            ]);
            // dd($appointment);
            $mytime = \Carbon\Carbon::now();

            Notification::create([
                'day' => $mytime->format('h:i:s A'),
                'message' => 'Approved Appointment',
            ]);
            // $mytime = \Carbon\Carbon::now();
            // $fullName = $data['first_name'] . ' ' . $data['last_name'];

            PatientNotification::create([
                'patient_id' => $appointment->profile_id,
                'day' => $mytime->format('h:i:s A'),
                'message' => 'Your Appointment Approved Successfully',
            ]);
            $appointment->save();
            return redirect()->back()->with('approved', 'success');
        }

        // dd($appointment->status);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        // dd('aw');
        // dd($id);
        $delete = Notification::findorFail($id);
        $delete->delete();
        return redirect()->back()->with('delete', 'deleted');
    }
}
