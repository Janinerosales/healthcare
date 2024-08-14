<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\User;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $profiles = Profile::with('role')
            ->whereHas('role', function ($query) {
                $query->where('role_name', 'Doctor');
            })->simplePaginate(5);

        return view('Doctor.index', compact('profiles'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Doctor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'role' => 'required',
            'full_name' => 'required',
            'email' => 'required',
        ]);

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imagePath = $image->store('images', 'public');
            $data['profile_image'] = $imagePath;
        } else {
            $data['profile_image'] = null;
        }

        // $data['user_id'] =  User::create([
        //     'profile_image' => $data['profile_image'] ?? null,
        //     'name' => $data['first_name'] . ' ' . $data['last_name'],
        //     'email' => $email,
        //     'password' => 'healthcare2024',
        // ])->id;
        // dd($request->all());
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
