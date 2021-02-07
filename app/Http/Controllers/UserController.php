<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Crypt;
use DB;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{

            $data = $request->all(); 
            DB::beginTransaction();

            // SI VIENE id -> Actualizar
            if(isset($data["id"])){
                $user = User::find($data["id"]);
            }else{
                $user = new User();                
            }

            $user->name     = $data["name"];
            $user->email    = $data["email"];
            $user->document = $data["document"];
            $user->password = $data["password"] == "fakeSimulator" ? $user->password : Crypt::encrypt($data["password"]);
            $user->contact  = isset($data["contact"] ) ? $data["contact"] : "";
            $user->token    = Str::random(10);
            $user->save();
            DB::commit();

            return JsonResponse::create(array('message' =>"Usuario Guardado Correctamente", "content"=>$user, "isError"=>false, "isFail"=>false, "isOk"=>true), 200);

        }catch (Exception $exc) {
            DB::rollBack();
            return JsonResponse::create(array('message' => "Error al guardar", 'error'=> $exc->getTraceAsString(), "status_code"=>400, "isError"=>true, "isFail"=>true, "isOk"=>false), 400);
            
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
