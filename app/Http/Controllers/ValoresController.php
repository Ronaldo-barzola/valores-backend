<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ValoresController extends Controller
{

    public function grabarProcesoDeuda(Request $request)
    {
	
        $p_secuen  = intval($request['p_secuen']);
        $p_fecpro = strval(date('Y-d-m', strtotime($request['p_fecpro'])));
        $p_anoini = intval($request['p_anoini']);
        $p_anofin = intval($request['p_anofin']);
        $p_perini = intval($request['p_perini']);
        $p_perfin = intval($request['p_perfin']);
        $p_tipcon = intval($request['p_tipcon']);
        $p_tipval = intval($request['p_tipval']);
        $p_disdfu = intval($request['p_disdfu']);
        $p_sector = $request['p_sector'];
        $p_monini = $request['p_monini'];
        $p_monfin = $request['p_monfin'];
      	

        $pdo = DB::connection('sqlsrv')->getPdo();
	
	$stmt = $pdo->prepare("EXEC [dbo].[sp_procesodeuda_gen] :p_secuen, :p_fecpro, :p_anoini, :p_anofin, :p_perini, :p_perfin, :p_tipcon, :p_tipval, :p_disdfu, :p_sector, :p_monini, :p_monfin");
        

        $stmt->bindParam(':p_secuen', $p_secuen, PDO::PARAM_INT);
	$stmt->bindParam(':p_fecpro', $p_fecpro, PDO::PARAM_STR);
        $stmt->bindParam(':p_anoini', $p_anoini, PDO::PARAM_INT);
        $stmt->bindParam(':p_anofin', $p_anofin, PDO::PARAM_INT);
        $stmt->bindParam(':p_perini', $p_perini, PDO::PARAM_INT);
        $stmt->bindParam(':p_perfin', $p_perfin, PDO::PARAM_INT);
        $stmt->bindParam(':p_tipcon', $p_tipcon, PDO::PARAM_INT);
        $stmt->bindParam(':p_tipval', $p_tipval, PDO::PARAM_INT);
        $stmt->bindParam(':p_disdfu', $p_disdfu, PDO::PARAM_INT);
        $stmt->bindParam(':p_sector', $p_sector, PDO::PARAM_INT);
        $stmt->bindParam(':p_monini', $p_monini, PDO::PARAM_STR);
        $stmt->bindParam(':p_monfin', $p_monfin, PDO::PARAM_STR);
        $stmt->execute();

        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);
		
        return response()->json($results);
    }

    public function listarDeudaContrib(Request $request)
    {

        $p_pdlnid = $request['p_pdlnid'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_deuda_con] :p_pdlnid");

        $stmt->bindParam(':p_pdlnid', $p_pdlnid, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarDeudaDetalle(Request $request)
    {

        $p_pdlnid = $request['p_pdlnid'];
        $p_codcon = $request['p_codcon'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_deuda_det] :p_pdlnid, :p_codcon");

        $stmt->bindParam(':p_pdlnid', $p_pdlnid, PDO::PARAM_INT);
        $stmt->bindParam(':p_codcon', $p_codcon, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarProcDeuda(Request $request)
    {
        $p_fecini = date('Y-m-d', strtotime($request['p_fecini']));
        // $p_fecfin = $request['p_fecfin'];
        $p_fecfin = date('Y-m-d', strtotime($request['p_fecfin']));
        $p_tipval = intval($request['p_tipval']);
        $p_tipdfd  = intval($request['p_tipdfd']);
        $p_sector = $request['p_sector'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("exec [dbo].[lista_proceso_deuda] :p_fecini, :p_fecfin, :p_tipval, :p_tipdfd, :p_sector");

        $stmt->bindParam(':p_fecini', $p_fecini, PDO::PARAM_STR);
        $stmt->bindParam(':p_fecfin', $p_fecfin, PDO::PARAM_STR);
        $stmt->bindParam(':p_tipval', $p_tipval, PDO::PARAM_INT);
        $stmt->bindParam(':p_tipdfd', $p_tipdfd, PDO::PARAM_INT);
        $stmt->bindParam(':p_sector', $p_sector, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarProcDeudaDet(Request $request)
    {
        $p_pdlnid = $request['p_pdlnid'];

        $pdo = DB::connection('sqlsrv')->getPdo();
        $stmt = $pdo->prepare("EXEC [dbo].[lista_proceso_det] :p_pdlnid");
        $stmt->bindParam(':p_pdlnid', $p_pdlnid, PDO::PARAM_INT);
        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }
}
