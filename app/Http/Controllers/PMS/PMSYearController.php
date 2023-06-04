<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use App\Models\PMS\PMSYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PMSYearController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $years = PMSYear::orderBy('id', 'desc')->paginate(10);
        return view('pmsConfig.year.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pmsConfig.year.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|unique:p_m_s_years,name',
            'status' => 'required',
        ]);
        try {
            PMSYear::create([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error',  $ex->getMessage());
        }

        return redirect()->route('pmsConfig.year.index')->with('success', 'PMS Year has been created successfully.');
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
        $year = PMSYear::whereId($id)->first();
        return view('pmsConfig.year.edit', compact('year'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            'name' => 'required|unique:p_m_s_years,name,'.$id,
            'status' => 'required',
        ]);
        try {
            PMSYear::whereId($id)->update([
                'name' => $request->name,
                'status' => $request->status
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error',  $ex->getMessage());
        }

        return redirect()->route('pmsConfig.year.index')->with('success', 'PMS Year has been updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id)
    {
        try {
          DB::beginTransaction();
          PMSYear::whereId($id)->delete();
            DB::commit();
        } catch (\Exception $ex) {
            DB::rollback();
            return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
        }
        return  response()->json(['status' => true, 'mes' => 'PMS Year Data Deleted Successfully']);
    }
}
