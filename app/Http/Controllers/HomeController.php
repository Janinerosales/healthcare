<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Profile;
use App\Models\Appointment;
use App\Models\Notification;
use App\Models\PatientNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    //

    public function dashboard(Request $request)
    {
        //Appointment
        // dd(auth()->user());
        // dd($request->input('user_id'));


        $totalAppointment =  Appointment::count();
        $upcomingAppointment = Appointment::where('status', 'Pending')->count();
        $completedAppointment = Appointment::where('status', 'Approved')->count();
        $todayAppointment = Appointment::where('date_now',  now()->format('Y-m-d'))->count();
        $rescheduleAppointment = Appointment::where('update', 1)->count();

        //Patient
        $totalPatient = Profile::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', 'Patient');
        })->count();

        //Doctor
        $totalDoctor = Profile::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', 'Doctor');
        })->count();

        //Notification

        // dd($totalPatient);
        // dd($rescheduleAppointment);
        // dd(now(date()));
        // dd($todayAppointment);
        // dd($upcomingAppointment);
        return view('index', compact('totalAppointment', 'upcomingAppointment', 'completedAppointment', 'todayAppointment', 'rescheduleAppointment', 'totalPatient', 'totalDoctor'));
    }

    public function home()
    {
        $notification = Notification::get();
        return view('home');
    }

    //patientProfile

    public function viewPatient(string $id)
    {
        $userIdPatient = Profile::where('user_id', $id)->first();
        $profiles = Profile::with('user')->findOrFail($userIdPatient->id ?? '');

        $appointments = Appointment::with('doctor')->where('profile_id', $userIdPatient->id)->simplePaginate(5);

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
        return view('PatientRole.profilePatient', compact('profiles', 'appointments', 'user', 'doctors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function CreatePatientAppointment(string $id)
    {
        $doctors = Profile::with('role')
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'Doctor');
            })->simplePaginate(5);

        return view('PatientRole.createAppointment', compact('doctors'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    public function recordPatient(string $id)
    {
        $profile = Profile::findorFail($id);
        return view('patientRole.recordPatient', compact('profile'));
    }

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

    public function createAppointment(Request $request)
    {
        $data = $request->validate([
            // 'user_id' => $request['user_id'],
            'profile_id' => 'required',
            // 'doctor_id' => 'required',
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
            'message' => 'Update Appointment',
        ]);
        return redirect()->to('patientRole/' . $data['user_id'])->with('add_success', 'succeses');
    }

    ///////Doctor Role
    public function doctorDashboard()
    {
        // dd('aw');
        $totalAppointment =  Appointment::count();
        $upcomingAppointment = Appointment::where('status', 'Pending')->count();
        $completedAppointment = Appointment::where('status', 'Approved')->count();
        $todayAppointment = Appointment::where('date_now',  now()->format('Y-m-d'))->count();
        $rescheduleAppointment = Appointment::where('update', 1)->count();

        //Patient
        $totalPatient = Profile::with('role')->whereHas('role', function ($query) {
            $query->where('role_name', 'Patient');
        })->count();

        //Doctor
        // $totalDoctor = Profile::with('role')->whereHas('role', function ($query) {
        //     $query->where('role_name', 'Doctor');
        // })->count();

        //Notification

        // dd($totalPatient);
        // dd($rescheduleAppointment);
        // dd(now(date()));
        // dd($todayAppointment);
        // dd($upcomingAppointment);
        return view('DoctorRole.dashboard', compact('totalAppointment', 'upcomingAppointment', 'completedAppointment', 'todayAppointment', 'rescheduleAppointment', 'totalPatient'));
    }
}
