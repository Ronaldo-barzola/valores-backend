<?php

/** @var \Laravel\Lumen\Routing\Router $router */

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return 'Backend';
});




$router->group(['prefix' => 'api'], function () use ($router) {
$router->get('/v1', function () use ($router) {
    return 'Bacaakend';
});
        $router->post('v2', 'ExampleController@tipoValorListar');

});

$router->group(['prefix' => 'v1'], function () use ($router) {

    $router->group(['prefix' => 'valores'], function () use ($router) {

        $router->post('procdeuda/guardar', 'ValoresController@grabarProcesoDeuda');
        $router->post('deudacontri/listar', 'ValoresController@listarDeudaContrib');
        $router->post('deudadetalle/listar', 'ValoresController@listarDeudaDetalle');
        $router->post('proceso/listar', 'ValoresController@listarProcDeuda');
        $router->post('proceso/listar/detalle', 'ValoresController@listarProcDeudaDet');
    });

    $router->group(['prefix' => 'general'], function () use ($router) {
        $router->post('tipovalor/listar', 'GeneralController@tipoValorListar');
        $router->post('ubicacion/listar', 'GeneralController@ubicacionListar');
        $router->post('tipocontri/listar', 'GeneralController@tipoContriListar');
        $router->post('tiposector/listar', 'GeneralController@tipoSectorListar');
    });

    $router->group(['prefix' => 'lotes'], function () use ($router) {
        $router->post('lotemision/listar', 'LoteController@listar');
        $router->post('lotemision/guardar', 'LoteController@guardarLote');
        $router->post('lotedetalle/listar', 'LoteController@listarLoteDetalle');
        $router->post('lotemision/listado-contrib', 'LoteController@listadoContrib');
        $router->post('lotemision/deuda-contrib', 'LoteController@deudaContrib');
        $router->post('lotemision/anular-contrib', 'LoteController@anulaContribLote');
        $router->post('lotevalor/listar', 'LoteController@listarValorLote');
        $router->post('lotevalorcon/listar', 'LoteController@listarValorLoteCon');
        $router->post('lotevalordet/listar', 'LoteController@listarDetValorLoteCon');
    });

    $router->group(['prefix' => 'planillas'], function () use ($router) {
    });

    $router->group(['prefix' => 'coactivo'], function () use ($router) {
    });
});



