<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('user-list')) {
            $users = User::all();
            return view('user.index', compact('users'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('user-create')) {
            $roles = Role::select('id', 'name')->get();

            return view('user.create', compact('roles'));
        }
        abort(403, "You have no permission! 😒");
    }

    protected function validator(array $data)
    {

        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'mobile' => ['required', 'string'],
            'user_id' => ['required', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:4', 'confirmed'],
        ]);
    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        if (auth()->user()->can('user-create')) {
            $this->validator($request->all());

            try {
                DB::beginTransaction();
                $user = User::create([
                    'name' => $request['name'],
                    'mobile' => $request['mobile'],
                    'email' => $request['email'],
                    'user_id' => $request['user_id'],
                    'password' => Hash::make($request['password']),
                ]);
                DB::commit();
            } catch (\Exception $ex) {
                DB::rollBack();
                return redirect()->back()->with('error',  $ex->getMessage());
            }

            return redirect()->route('user.index')->with('success', 'User has been created successfully');
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
        if (auth()->user()->can('user-edit')) {
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->can('user-edit')) {
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (auth()->user()->can('user-delete')) {
        }
        abort(403, "You have no permission! 😒");
    }
}
