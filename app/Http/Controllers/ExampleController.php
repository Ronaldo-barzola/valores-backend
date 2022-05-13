<?php

namespace App\Http\Controllers;

use PDO;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;


class ExampleController extends Controller
{

	public function tipoValorListar(Request $request)
    {
	
$p_tipval = $request['p_tipval'];


        $pdo = DB::connection('sqlsrv')->getPdo();
return "ok";

        $stmt = $pdo->prepare("EXEC [dbo].[lista_pretipval] :p_tipval");

        $stmt->bindParam(':p_tipval', $p_tipval, PDO::PARAM_INT);

        $stmt->execute();
        $results = $stmt->fetchAll(\PDO::FETCH_OBJ);

        return response()->json($results);
    }

	
}
