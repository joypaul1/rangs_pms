<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('permission-list')) {
            $permissions = Permission::orderBy('id', 'desc')->paginate(20);
            return view('permission.index', compact('permissions'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('permission-create')) {
            return view('permission.create');
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('permission-create')) {
            $request->validate([
                'name' => 'required|unique:permissions,name',
            ]);
            try {
                DB::beginTransaction();
                Permission::create([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                ]);
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with('error',  $ex->getMessage());
            }

            return redirect()->route('permission.index')->with('success', 'permission has been created successfully.');
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
        if (auth()->user()->can('permission-edit')) {
            $permission = Permission::whereId($id)->first();
            return view('permission.edit', compact('permission'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->can('permission-edit')) {

            try {
                $request->validate([
                    'name' => 'required|unique:permissions,name,' . $id,
                ]);
                DB::beginTransaction();
                Permission::whereId($id)->update([
                    'name' => $request->name,
                    'slug' => Str::slug($request->name),
                ]);
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with('error',  $ex->getMessage());
            }
            return redirect()->route('permission.index')->with('success', 'permission has been created successfully.');
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        if (auth()->user()->can('permission-delete')) {
            try {
                DB::beginTransaction();
                $permission->delete();
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
            }
            return  response()->json(['status' => true, 'mes' => 'Data Deleted Successfully']);
        }
        abort(403, "You have no permission! 😒");
    }
}
