<?php

namespace App\Http\Controllers\Report;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $roles = Role::orderBy('id', 'desc')->paginate(10);
        return view('tour.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tour.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:roles,name',
        ]);
        try {
            Role::create([
                'name' => $request->name,
                'slug' => Str::slug($request->name),
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error',  $ex->getMessage());
        }

        return redirect()->route('role.index')->with('success', 'Role has been created successfully.');
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
        return view('role.edit');
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
    public function destroy(Role $role)
    {
        try {
            $role->delete();
        } catch (\Exception $ex) {
            return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
    }
}
