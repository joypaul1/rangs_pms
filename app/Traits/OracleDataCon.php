<?php

namespace App\Traits;

use App\Models\Server\ServerConnection;

// namespace App\Models\Server\ServerConnection as OracleModel;

trait OracleDataCon
{
    public static function dataBaseConnect()
    {
        $connect = ServerConnection::first();
        // dd(  $connect->DB_USERNAME, $connect->DB_PASSWORD, $connect->DB_HOST.":".$connect->DB_PORT."/". $connect->DB_DATABASE, "DEVELOPERS2","Test1234","192.168.172.61:1521/xe");
        // $conn = oci_connect($connect->DB_USERNAME, $connect->DB_PASSWORD, $connect->DB_HOST.":".$connect->DB_PORT."/". $connect->DB_DATABASE, 'AL32UTF8');
        $conn=oci_connect("DEVELOPERS2","Test1234","192.168.172.61:1521/xe",'AL32UTF8');
        if (!$conn) {
            $e = oci_error();
            // trigger_error(htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR);
            return (['status' => false, 'conn' => htmlentities($e['message'], ENT_QUOTES), E_USER_ERROR]);
        }

        return (['status' => true, 'conn' => $conn]);

    }
}
