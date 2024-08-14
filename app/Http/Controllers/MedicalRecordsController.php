<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use App\Models\MedicalRecords;

class MedicalRecordsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $patients = Profile::with('role', 'appointments')->whereHas('role', function ($query) {
            $query->where('role_name', 'Patient');
        })->Paginate(5);


        return view('MedicalRecord.index', compact('patients'))->with('i', (request()->input('page', 1) - 1) * 5);
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
    public function show(MedicalRecords $medicalRecords)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
        $profile = Profile::findorFail($id);
        return view('MedicalRecord.view', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, MedicalRecords $medicalRecords)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MedicalRecords $medicalRecords)
    {
        //
    }
}
