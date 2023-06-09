<?php

namespace App\Http\Controllers\PMS;

use App\Http\Controllers\Controller;
use App\Models\PMS\PMSYear;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Traits\OracleDataCon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class PMSYearController extends Controller
{
    use OracleDataCon;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        // JOIN RML_HR_APPS_USER ON HR_PMS_LIST.CREATED_BY = RML_HR_APPS_USER.RML_I?D
        if (auth()->user()->can('pms-year-list')) {
            $oracleDatabase = self::dataBaseConnect();
            $yearData = [];
            if ($oracleDatabase['status']) {
                $sql = oci_parse($oracleDatabase['conn'], 'SELECT ID as UNIQUEID, PMS_NAME,CREATED_BY,CREATED_DATE,BG_COLOR,CLOSED_DATE,
                IS_ACTIVE,CLOSED_BY,TABLE_REMARKS FROM HR_PMS_LIST');
                oci_execute($sql);
                $nrows = oci_fetch_all($sql, $resData);

                for ($i = 0; $i < (int)$nrows; $i++) {
                    $yearData[$i] = [
                        'id' => $resData['UNIQUEID'][$i],
                        'pms_name' => $resData['PMS_NAME'][$i],
                        'user_id' => $resData['CREATED_BY'][$i],
                        'created_date' => $resData['CREATED_DATE'][$i],
                        'status' => $resData['IS_ACTIVE'][$i],
                    ];
                }

                $yearData = $this->paginate($yearData);

                return view('pmsConfig.year.index', compact('yearData'));
            } else {
                abort(500, 'Something went wrong');
            }

            abort(403, "You have no permission! 😒");
        }
    }

    public function paginate($items, $perPage = 20, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (auth()->user()->can('pms-year-create')) {
            return view('pmsConfig.year.create');
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->AlL());
        if (auth()->user()->can('pms-year-create')) {
            $oracleDatabase = self::dataBaseConnect();

            try {
                // foreach ($request->name as $data) {
                    if ($oracleDatabase['status']) {
                        $strSQL  = oci_parse($oracleDatabase['conn'], "INSERT INTO HR_PMS_LIST (PMS_NAME,CREATED_BY,CREATED_DATE,IS_ACTIVE,BG_COLOR,TABLE_REMARKS)VALUES ('$request->name' ,'RML-00955' , SYSDATE ,'$request->status' , 'card bg-success text-white mb-4' , '' )");
                        if (oci_execute($strSQL)) {
                            return redirect()->route('pmsConfig.year.index')->with('success', 'PSM Year has been created successfully.');
                        } else {
                            $lastError = error_get_last();
                            $error = $lastError ? "" . $lastError["message"] . "" : "";
                            return redirect()->back()->with('error',  $error);
                        }
                    }
                // }
            } catch (\Exception $ex) {

                return redirect()->back()->with('error',  $ex->getMessage());
            }
            return redirect()->route('pmsConfig.year.index')->with('success', 'PMS Year has been created successfully.');
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
        if (auth()->user()->can('pms-year-edit')) {
            $oracleDatabase = self::dataBaseConnect();
            $sql = oci_parse($oracleDatabase['conn'], 'SELECT * FROM HR_PMS_LIST WHERE ID = ' . $id);
            oci_execute($sql);
            $year = oci_fetch_assoc($sql);
            // dd($year );
            return view('pmsConfig.year.edit', compact('year'));
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $oracleDatabase = self::dataBaseConnect();
        // dd($request->all());
        //
        // // // Prepare the update statement UPDATE HR_PMS_LIST SET PMS_NAME = $request->name WHERE ID =" . $id
        // $query = "UPDATE HR_PMS_LIST SET PMS_NAME = :new_pms WHERE ID = :user_id";
        // $statement = oci_parse($oracleDatabase['conn'], $query);

        // // Bind the parameters
        // $new_pms = $request->name;
        // $user_id = $id;
        // oci_bind_by_name($statement, ":new_pms", $new_pms);
        // oci_bind_by_name($statement, ":user_id", $user_id);

        // // Execute the update statement
        // $result = oci_execute($statement);
        // if ($result) {
        //     echo "Data updated successfully.";
        // } else {
        //     $error = oci_error($statement);
        //     echo "Update failed: " . $error['message'];
        // }

        // // Clean up resources
        // oci_free_statement($statement);
        // oci_close($oracleDatabase['conn']);
        if (auth()->user()->can('pms-year-edit')) {

            try {
                if ($request->name) {
                    if ($oracleDatabase['status']) {
                        $query = "UPDATE HR_PMS_LIST SET PMS_NAME = :new_pms WHERE ID = :user_id AND IS_ACTIVE = :active";
                        $statement = oci_parse($oracleDatabase['conn'], $query);

                        // Bind the parameters
                        $new_pms = $request->name;
                        $user_id = $id;
                        $active = $request->status;
                        // dd($active);
                        oci_bind_by_name($statement, ":new_pms", $new_pms);
                        oci_bind_by_name($statement, ":user_id", $user_id);
                        oci_bind_by_name($statement, ":active",$active);

                        // $result = oci_execute($strSQL, OCI_COMMIT_ON_SUCCESS);
                        $result = oci_execute($statement);
                        // dd( $result );
                        if ($result) {
                            return redirect()->route('pmsConfig.year.index')->with('success', 'PMS Year has been created successfully.');
                        } else {
                            $error = oci_error($statement);
                            return redirect()->back()->with('error',  $error['message']);
                        }
                        oci_close($oracleDatabase['conn']);
                    }
                }
            } catch (\Exception $ex) {
                dd($ex->getMessage());

                return redirect()->back()->with('error', $ex->getMessage());
            }
            return redirect()->back()->with('success', 'PMS Year has been Updated successfully.');
        }
        abort(403, "You have no permission! 😒");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        if (auth()->user()->can('pms-year-delete')) {
            try {
                $oracleDatabase = self::dataBaseConnect();
                $sql = oci_parse($oracleDatabase['conn'], 'DELETE  FROM HR_PMS_LIST WHERE ID = ' . $id);
                oci_execute($sql);
                $result = oci_execute($sql, OCI_DEFAULT);
                if ($result) {
                    oci_commit($oracleDatabase['conn']); //*** Commit Transaction ***//
                    return  response()->json(['status' => true, 'mes' => 'PMS Year Data Deleted Successfully']);
                } else {
                    $error = oci_error($sql);
                    return redirect()->back()->with('error',  $error['message']);
                }
            } catch (\Exception $ex) {
                return response()->json(['status' => false, 'mes' => $ex->getMessage()]);
            }
            return  response()->json(['status' => true, 'mes' => 'PMS Year Data Deleted Successfully']);
        }
        return response()->json(['status' => false, 'mes' => 'Sorry ! You have no permission! 😒']);

    }
}
