<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppointmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        // dd($id);
        $doctors = Profile::with('role')
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'Doctor');
            })->simplePaginate(5);

        return view ('Patient.Appointment.create', compact('doctors'))->with('i', (request()->input('page', 1) - 1) * 5);
    } 

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // dd('kjdsafksaf');
        //
        // $u =  auth()->user()->id;

        // dd(auth()->user());
        // $user = User::findorFail($request['user_id']);
        // dd($user);

        $data = $request->validate([
            // 'user_id' => $request['user_id'],
            'profile_id' => 'required',
            'doctor_id' => 'required',
            'requests' => 'required',
            'appointment_date' => 'required',
        ]);

        if ($request['user_id']) {
            $data['user_id'] = $request['user_id'];
        }
        if ($request['status']) {
            $data['status'] = $request['status'];
        }
        // dd($data);
        Appointment::create($data);
        $mytime = \Carbon\Carbon::now();

        Notification::create([
            'day' => $mytime->format('h:i:s A'),
            'message' => 'Add Appointment',
        ]);

        // dd($data['profile_id']);
        // $profileNumber = Profile::findorFail($data['profile_id'])->phone_number;

        // dd($profileNumber);
        // Http::asForm()->post('https://api.semaphore.co/api/v4/messages', [
        //     'apikey' => env('SMS_API_KEY'),
        //     'number' => $profileNumber, 
        //     'message' => 'You Have New Appointment',
            // ]);
        return redirect()->route('patient.edit', $data['profile_id'])->with('add_success', 'succeses');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //=
        $profile = Profile::where('user_id', $id)->with('appointments')->first();

        // dd($profile->id);
        return redirect()->to('patient/' . $profile->id . '/edit');
        // dd($profile);


        // $appointment = Appointment::where('profile_id', $id);
        // // dd($appointment);
        // // dd($appointment);
        // return view('Patient.Appointment.appointment_view', compact('appointment'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //

        // dd($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        // dd($request->all());
        $data = $request->validate([
            // 'user_id' => $request['user_id'],
            'profile_id' => 'required',
            // 'doctor_id' => 'required',
            'requests' => 'required',
            'appointment_date' => 'required',
        ]);

        // dd($request->all());

        if ($request['user_id']) {
            $data['user_id'] = $request['user_id'];
        }
        if ($request['status']) {
            $data['status'] = $request['status'];
        }
        $profile = Appointment::findorFail($id);

        if ($profile['appointment_date'] != $data['appointment_date']) {
            $profile->update([
                'update' => 1,
            ]);
        }

        $profile->update($data);
        $mytime = \Carbon\Carbon::now();

        Notification::create([
            'day' => $mytime->format('h:i:s A'),
            'message' => 'Update Appointment',
        ]);
        // dd($profile->doctor_id);
        $profile->save();
        return redirect()->back()->with('update_success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $delete = Appointment::findorFail($id);
        $delete->delete();
        return redirect()->back()->with('delete', 'success');
    }
}
