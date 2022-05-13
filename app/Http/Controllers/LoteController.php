<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LoteController extends Controller
{

    public function guardarLote(Request $request) {

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

        $stmt = $pdo->prepare("EXEC [dbo].[sp_procesolotes_gen] :p_secuen, :p_fecpro, :p_anoini, :p_anofin, :p_perini, :p_perfin, :p_tipcon, :p_tipval, :p_disdfu, :p_sector, :p_monini, :p_monfin");

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

    public function listar(Request $request) {

        $p_fecini = $request['p_fecini'];
        $p_fecfin = $request['p_fecfin'];
        $p_tipval = $request['p_tipval'];
        $p_tipdfd = $request['p_tipdfd'];
        $p_sector = $request['p_sector'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_emisionlote_cab] :p_fecini, :p_fecfin, :p_tipval, :p_tipdfd, :p_sector");

        $stmt->bindParam(':p_fecini', $p_fecini, PDO::PARAM_STR);
        $stmt->bindParam(':p_fecfin', $p_fecfin, PDO::PARAM_STR);
        $stmt->bindParam(':p_tipval', $p_tipval, PDO::PARAM_INT);
        $stmt->bindParam(':p_tipdfd', $p_tipdfd, PDO::PARAM_INT);
        $stmt->bindParam(':p_sector', $p_sector, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarLoteDetalle(Request $request){
        $p_elcnid = $request['p_elcnid'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_emisionlote_det] :p_elcnid");

        $stmt->bindParam(':p_elcnid', $p_elcnid, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }


    public function listadoContrib(Request $request) {

        $p_elcnid = $request['p_elcnid'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_emisionlote_con] :p_elcnid");

        $stmt->bindParam(':p_elcnid', $p_elcnid, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }


    public function deudaContrib(Request $request) {

        $p_elcnid = $request['p_elcnid'];
        $p_codcon = $request['p_codcon'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_emisionlote_det] :p_elcnid, :p_codcon");

        $stmt->bindParam(':p_elcnid', $p_elcnid, PDO::PARAM_INT);
        $stmt->bindParam(':p_codcon', $p_codcon, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function anulaContribLote(Request $request) {

        $p_elc_id = $request['p_elc_id'];
        $p_codcon = $request['p_codcon'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[sp_anula_contri_lote_val] :p_elc_id, :p_codcon");

        $stmt->bindParam(':p_elc_id', $p_elc_id, PDO::PARAM_INT);
        $stmt->bindParam(':p_codcon', $p_codcon, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarValorLote(Request $request) {

        $p_anypro = $request['p_anypro'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_valorlot_sel] :p_anypro");

        $stmt->bindParam(':p_anypro', $p_anypro, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarValorLoteCon(Request $request) {

        $p_anylot = $request['p_anylot'];
        $p_numlot = $request['p_numlot'];

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_valorlot_con] :p_anylot, :p_numlot");

        $stmt->bindParam(':p_anylot', $p_anylot, PDO::PARAM_INT);
        $stmt->bindParam(':p_numlot', $p_numlot, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

    public function listarDetValorLoteCon(Request $request) {

        $p_anylot = $request['p_anylot'];
        $p_numlot = $request['p_numlot'];
        $p_codcon = $request['p_codcon'];
        $p_tipval = $request['p_tipval'];	

        $pdo = DB::connection('sqlsrv')->getPdo();

        $stmt = $pdo->prepare("EXEC [dbo].[lista_valorlot_cde] :p_anylot, :p_numlot, :p_codcon, :p_tipval");

        $stmt->bindParam(':p_anylot', $p_anylot, PDO::PARAM_INT);
        $stmt->bindParam(':p_numlot', $p_numlot, PDO::PARAM_INT);
        $stmt->bindParam(':p_codcon', $p_codcon, PDO::PARAM_INT);
        $stmt->bindParam(':p_tipval', $p_tipval, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }



   
}


