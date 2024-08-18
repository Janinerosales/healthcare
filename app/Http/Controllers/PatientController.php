<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Role;
use App\Models\User;
use App\Models\Profile;
use App\Models\Appointment;
use App\Models\Notification;
use Illuminate\Http\Request;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //

        $profiles = Profile::with('role')
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'Patient');
            })
            ->simplePaginate(5);
        foreach ($profiles as $profile) {
            $profile->birth_of_birth = Carbon::parse($profile->date_of_birth)->isoFormat('MMMM DD, YYYY');
        }

        return view('Patient.index', compact('profiles'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Patient.create');
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
        // dd($id);
        $profiles = Profile::with('user')->findOrFail($id);

        $appointments = Appointment::with('doctor')->where('profile_id', $id)->simplePaginate(5);

        // dd($appointments);
        $user = $profiles->user;

        foreach ($appointments as $appointment) {
            $appointment->appointment_date = Carbon::parse($appointment->appointment_date)->isoFormat('MMMM DD, YYYY');
        }

        $doctors = Profile::with('role')
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'Doctor');
            })->simplePaginate(5);

        if ($appointments->isEmpty()) {
        }



        // dd($profiles);
        return view('Patient.edit', compact('profiles', 'appointments', 'user', 'doctors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
        $profile = Profile::findorFail($id);
        $data = $request->validate([
            'first_name' => 'required',
            'middle_name'   => 'required',
            'last_name' => 'required',
            'date_of_birth' => 'required',
            'gender' => 'required',
            'address' => 'required',
            'phone_number' => 'required',
            'email' => 'required',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imagePath = $image->store('images', 'public');
            $data['profile_image'] = $imagePath;
        } else {
            // $data['profile_image'];
        }

        // if ($request['specialization']) {
        //     $data['specialization'] = $request['specialization'];
        // } else {
        //     $data['specialization'] = null;
        // }

        // dd($data);
        $profile->update($data);
        // dd($data);
        return redirect()->back()->with('update_success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $delete = Profile::findorFail($id);

        $mytime = \Carbon\Carbon::now();

        Notification::create([
            'day' => $mytime->format('h:i:s A'),
            'message' => 'Deleted Patient' . '/' . $delete['full_name'] . '-',
        ]);
        $delete->delete();

        return redirect()->route('patient.index')->with('delete', 'success');
    }
}
    