<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
include_once '../Model/Denuncia.php';
include_once '../Dao/DaoDenuncia.php';
include_once '../Model/Usuario.php';
include_once '../lib/nusoap.php';
header("contentType: application/json; charset=utf-8");
function BuscarDenuncias()
{
    $daoDenuncia = new DaoDenuncia();
    $listPublicacion = $daoDenuncia->BuscarDenuncia();
    return $listPublicacion;
}
    $server= new soap_server;
    $server->configureWSDL('denuncia','urn:denuncia');
    $server->register('Denuncia',
            array(),
            array('listPublicacion'=>'xsd:array'),
            'urn:denuncia',
            'urn:denuncia#BuscarDenuncia',
            'rpc',
            'encoded',
            '1=> : Buscar los post denunciados');
    
    if ( !isset( $HTTP_RAW_POST_DATA ) ) $HTTP_RAW_POST_DATA =file_get_contents( 'php://input' );
$server->service($HTTP_RAW_POST_DATA);
// create HTTP listener 
//$server->service($HTTP_RAW_POST_DATA); 
exit(); 