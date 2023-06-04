<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use App\Models\PMS\KRA;
use App\Models\PMS\PMSYear;
use Illuminate\Http\Request;

class KpiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->can('pms-kpi-list')) {
            $years = KRA::where('user_id', auth()->user()->id)->orderBy('id', 'desc')
                ->with('activeYear')
                ->paginate(10);
            return view('pmsConfig.kpi.index', compact('years'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('pms-kpi-create')) {
            $year = PMSYear::whereStatus(1)->first();
            return view('pmsConfig.kpi.create', compact('year'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (auth()->user()->can('pms-kpi-create')) {
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

            return redirect()->route('pmsConfig.kpi.index')->with('success', 'PMS Year has been created successfully.');
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
        if (auth()->user()->can('pms-kpi-edit')) {
            $kra = KRA::whereId($id)->with('year')->first();
            return view('pmsConfig.kpi.edit', compact('kra'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (auth()->user()->can('pms-kpi-edit')) {
            $request->validate([
                'name' => 'required|string',
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

            return redirect()->route('pmsConfig.kpi.index')->with('success', 'PMS Year has been updated successfully.');
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (auth()->user()->can('pms-kpi-delete')) {
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
        abort(403, "You have no permission! 😒");
    }
}
