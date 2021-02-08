<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\wallet;
use App\Models\User;
use vendor\econea\nusoap\src\nusoap;
use nusoap_server;
use addComplextype;
use Illuminate\Http\Response;

class SoapController extends Controller
{
    public function registrarUsuario() {
       // require_once "nusoap.php";
        $server = new nusoap_server();
        $namespace = "Registro";
        $server->configureWSDL("RegistrarUsiariosBilletera", $namespace);
        $server->wsdl->schemaTargetNamespace = $namespace;
            $server->wsdl->addComplexType(
                'registrarUsuario',
                'complexType',
                'struct',
                'all',
                '',
                array(
                    'Name' =>array('name' =>'name', 'type'=>'xsd:string'),
                    'Email' =>array('name' =>'email', 'type'=>'xsd:string'),
                    'Document' =>array('name' =>'document', 'type'=>'xsd:string'),
                    'Contact' =>array('name' =>'contact', 'type'=>'xsd:string')
                )
            );
        $server->wsdl->addComplexType(
            'response',
            'complexType',
            'struct',
            'all',
            '',
            array(
                'Usuario' =>array('name' =>'Usuario', 'type'=>'xsd:string'),
                'Resultado' =>array('name' =>'Resultado', 'type'=>'xsd:boolean'),
            )
        );

        $server->register(
            'guardarUsuario',
            array('name' =>'tns:registrarUsuario'),
            array('name' =>'tns:response'),
            $namespace,
            false,
            'rpc',
            'encoded',
            'Recibe un usario y regresa una confirmacion'

        );

        function guardarUsuario($request){
            return array(
                "usuario" => "el usuario ".$request['Name']." se encuentra registrado",
                "Resultado" =>true
            );
        }
        $POST_DATA = file_get_contents("php://input");
        $server->service($POST_DATA);
        exit();
    }

} 

