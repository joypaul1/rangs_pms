<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use App\Models\PMS\KRA;
use App\Models\PMS\PMSYear;
use Illuminate\Http\Request;

class KraController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $years = KRA::orderBy('id', 'desc')
        ->with('activeYear')
        ->paginate(10);
        return view('pmsConfig.kra.index', compact('years'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
         $year = PMSYear::whereStatus(1)->first();
        return view('pmsConfig.kra.create', compact('year'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|unique:k_r_a_s,name',
            'note' => 'nullable|string',
        ]);
        try {
            KRA::create([
                'name' => $request->name,
                'user_id' => auth()->user()->id,
                'pms_year_id' =>  $request->pms_year_id,
                'note' => $request->note
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error',  $ex->getMessage());
        }

        return redirect()->route('pmsConfig.kra.index')->with('success', 'PMS Year has been created successfully.');
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
        $kra = KRA::whereId($id)->first();
        return view('pmsConfig.kra.edit', compact('kra'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // dd($request->all(), $id);
        $request->validate([
            'name' => 'required|string|unique:k_r_a_s,name,'.$id,
            'note' => 'nullable|string',
        ]);
        try {
            KRA::whereId($id)->update([
                'name' => $request->name,
                'note' => $request->note
            ]);
        } catch (\Exception $ex) {
            return redirect()->back()->with('error',  $ex->getMessage());
        }

        return redirect()->route('pmsConfig.kra.index')->with('success', 'PMS Year has been updated successfully.');
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
