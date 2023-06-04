<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('role-list')) {
            $roles = Role::orderBy('id', 'desc')->paginate(10);
            return view('role.index', compact('roles'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('role-list')) {
            return view('role.create');
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('role-list')) {
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
        abort(403, "You have no permission! 😒");
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
        if (auth()->user()->can('role-list')) {
            return view('role.edit');
        }
        abort(403, "You have no permission! 😒");
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
        if (auth()->user()->can('role-list')) {
            try {
                $role->delete();
            } catch (\Exception $ex) {
                return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
            }
            return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
        }
        abort(403, "You have no permission! 😒");
    }
}
