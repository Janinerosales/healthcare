<?php

namespace App\Http\Controllers;

use App\Models\Prescription;
use Illuminate\Http\Request;

class PrescriptionController extends Controller
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
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        // dd($request['profile_id']);
        // dd($request['doctor_id']);
        // dd($request->all());
        $data = $request->validate([
            'profile_id' => 'required',
            'appointment_id' => 'required',
            // 'doctor_id' => 'required',
            'dosage' => 'required',
            'medication' => 'required',
            'issued_date' => 'required',
            'description' => 'required'
        ]);
        // dd($data);
        if ($request['doctor_id']) {
            $data['doctor_id'] = $request['doctor_id'];
        }

        if ($request->hasFile('image_1')) {
            $image = $request->file('image_1');
            $imagePath = $image->store('images', 'public');
            $data['image_1'] =  $imagePath;
        }

        if ($request->hasFile('image_2')) {
            $image = $request->file('image_2');
            $imagePath = $image->store('images', 'public');
            $data['image_2'] =  $imagePath;
        }

        Prescription::create($data);

        return redirect()->back()->with('add_success', 'added');
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
    public function update(Request $request, Prescription $prescription)
    {
        //
        $data = $request->validate([
            'profile_id' => 'required',
            'appointment_id' => 'required',
            'doctor_id' => 'required',
            'dosage' => 'required',
            'medication' => 'required',
            'issued_date' => 'required',
            'description' => 'required'
        ]);

        if ($request->hasFile('image_1')) {
            $image = $request->file('image_1');
            $imagePath = $image->store('images', 'public');
            $data['image_1'] =  $imagePath;
        }

        if ($request->hasFile('image_2')) {
            $image = $request->file('image_2');
            $imagePath = $image->store('images', 'public');
            $data['image_2'] =  $imagePath;
        }

        if ($request['renew_date']) {
            $data['renew_date'] = $request['renew_date'];
        }


        $prescription->update($data);
        return redirect()->back()->with('update_success', 'updated');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $prescription =  Prescription::findorFail($id);
        $prescription->delete();
        return redirect()->back()->with('delete_success', 'deleted');
    }
}
