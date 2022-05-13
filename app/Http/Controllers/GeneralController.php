<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GeneralController extends Controller
{

    public function tipoValorListar(Request $request)
    {


  	$p_tipval = $request["p_tipval"];

        $pdo = DB::connection('sqlsrv')->getPdo();


        $stmt = $pdo->prepare("EXEC [dbo].[lista_pretipval] :p_tipval");

        $stmt->bindParam(':p_tipval', $p_tipval, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);
	
        return response()->json($results);

    }

    public function ubicacionListar(Request $request)
    {

        // $p_ubidfd = $request['p_ubidfd'];
        $p_ubidfd = 0;

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_preubidfd] :p_ubidfd");

        $stmt->bindParam(':p_ubidfd', $p_ubidfd, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function tipoContriListar(Request $request)
    {

        // $p_ubidfd = $request['p_ubidfd'];
        $p_tipcon = 0;

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_prclascon2] :p_tipcon");

        $stmt->bindParam(':p_tipcon', $p_tipcon, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function tipoSectorListar(Request $request)
    {

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_tipsector]");

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }
}
