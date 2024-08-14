<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\Notification;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $roles = Role::simplePaginate(5);

        return view('Role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('Role.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $data = $request->validate([
            'role_name' => 'required|unique:roles',
        ]);
        $mytime = \Carbon\Carbon::now();
        $roleName = $data['role_name'];

        Notification::create([
            'day' => $mytime->format('h:i:s A'),
            'message' => 'Add Role' . '/'  . $roleName . '-',
        ]);
        Role::create($data);

        return redirect()->route('role.index')->with('add_success', 'success');
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
        // $role = Role::findorFail($id);

        // return view('Role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //

        // $data = $request->validate([
        //     'role_name' => 'required',
        // ]);

        // $role = Role::findorFail($id);
        // $role->update($data);
        // return redirect()->route('role.index')->with('update_success', 'success');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $role = Role::findorFail($id);
        $role->delete();

        return redirect()->route('role.index')->with('delete', 'success');
    }
}
