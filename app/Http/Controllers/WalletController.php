<?php

namespace App\Http\Controllers;

use App\Models\wallet;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Crypt;
use DB;
use JWTAuth;
use App\Mail\ConfirmacionMailable;
use Mail;
use Tymon\JWTAuth\Exceptions\JWTException;

class WalletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        try{
            
            $data = $request->all();
            
            //Realizo operación matematica donde obtendré el saldo atribuible a cada 
            //numero de identificación
            $wallet   = wallet::orderBy('id','DESC')->get();
            $recarga  = DB::table('wallets')->where('tipo', 'recarga')->whereDocument($data['document'])->sum('amout');
            $pago     = DB::table('wallets')->where('tipo', 'pago')->whereDocument($data['document'])->sum('amout');
            $saldo    = $recarga - $pago;
            //Recibo los datos desde el frontend para devolver 
            //el saldo con un return o el error si los datos no coinciden
            $document = wallet::whereDocument($data['document'])->firstOrFail();
            $contact  = wallet::whereContact($data['contact'])->firstOrFail();
            return JsonResponse::create(array('message' =>"", "content"=> "El saldo actual es: $saldo", "isError"=>false, "isFail"=>false, "isOk"=>true), 200);
                                
        }catch (Exception $exc) {
            
            return JsonResponse::create(array('message' => "Error al consultar", 'error'=> $exc->getTraceAsString(), "status_code"=>400, "isError"=>true, "isFail"=>true, "isOk"=>false), 400);
            
        }
        
        
    }
    public function recarga(Request $request)
    {
        try{
            //Recibo todos los datos del formulario el campo "tipo" lo defecto
            //con el tipo "RECARGA" para diferenciarlos de los pagos
            $data    = $request->all();  
            DB::beginTransaction();    
            $wallet = new Wallet();       
            $wallet->amout    = $data["amout"];
            $wallet->document = $data["document"];
            $wallet->contact  = $data["contact"];
            $wallet->tipo    = Str::lower('RECARGA');
            $wallet->save();
            DB::commit();

            return JsonResponse::create(array('message' =>"Recarga realizada con exito", "isError"=>false, "isFail"=>false, "isOk"=>true), 200);

        }catch (Exception $exc) {
            DB::rollBack();
            return JsonResponse::create(array('message' => "Error al Recargar", 'error'=> $exc->getTraceAsString(), "status_code"=>400, "isError"=>true, "isFail"=>true, "isOk"=>false), 400);
            
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmar(Request $request)
    {    
        try{
            $data    = $request->all();
            DB::beginTransaction();  
            //RECUPERAMOS LOS DATOS EXISTENTES CON EL FIN DE VERIFICAR
            //QUE LOS DATOS QUE RECIBE EL FORMULARIO COINCIDEN  
           // $act       = DB::table('wallets')->where(['tipo', 'pendiente'])->update(['tipo' => 'pago']);;          
            $token     = Wallet::whereToken($data['token'])->first();
            $sesion    = Wallet::whereSesion($data['sesion'])->first();
            $wallet    = Wallet::whereToken($data['token'])->first();
            $wallet->tipo =  Str::lower('PAGO'); 
            $wallet->save();
            DB::commit();
            return JsonResponse::create(array('message' =>"Compra confirmada",  "isError"=>false, "isFail"=>false, "isOk"=>true), 200);            
        }catch (Exception $exc) {
            
            return JsonResponse::create(array('message' => "Error al comfirmar", 'error'=> $exc->getTraceAsString(), "status_code"=>400, "isError"=>true, "isFail"=>true, "isOk"=>false), 400);
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function pagar(Request $request)
    {
        try{
            //Recibo todos los datos del formulario y el campo "tipo" lo guardo por defecto
            //con el tipo "PENDIENTE" para confirmar el pago con otro servicio donde se 
            //requerirá el token y el id de sesión 
            $data    = $request->all(); 
                 
            $wallet = new Wallet();       
            $wallet->amout    = $data["amout"];
            $wallet->document = $data["document"];
            $wallet->contact  = $data["contact"];
            $wallet->tipo     = Str::lower('PENDIENTE');
            $wallet->token    = Str::random(6);
            $wallet->sesion   = Str::random(4);
            $wallet->save();
            //Enviamos el correo electronico con el token y el id de sesión
            $mail = new ConfirmacionMailable($wallet);
            Mail::to('mail@example.com')->send($mail);
            return JsonResponse::create(array('message' =>"Listo, ahora enviaremos un correo con el token y el id de sesión para confirmar esta compra..", "isError"=>false, "isFail"=>false, "isOk"=>true), 200);

        }catch (Exception $exc) {
            DB::rollBack();
            return JsonResponse::create(array('message' => "Error en la transación", 'error'=> $exc->getTraceAsString(), "status_code"=>400, "isError"=>true, "isFail"=>true, "isOk"=>false), 400);
            
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
