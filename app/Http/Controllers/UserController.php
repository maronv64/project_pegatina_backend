<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;
use Illuminate\Support\Facades\Crypt;
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
      $item     = '';
      $code     = '';
      $message  = '';
      $ignorar = array("/", ".", "$");

      try {

        $item = new User();
        $item->nome_token = str_replace($ignorar,"",bcrypt(Str::random(10)));
        $item->name = $request->nombre;
        $item->email = $request->correo;
        $item->password = Hash::make($request->clave);
        $item->password2 = $request->clave;

        $item->save();
        $code = '201';
        $message = 'created';

      } catch (\Exception $e) {
        $code = '500';
        $message = $e->getMessage();
      }

      $respuesta = array(
        'items' =>  $item,
        'code'  =>  $code,
        'message' =>  $message,
      );

      return response()->json($respuesta);

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

    public function validar_correo(Request $request)
    {
      $item     = '';
      $code     = '500';
      $message  = '';
      $message_exception = '';
      $ignorar = array("/", ".", "$");

      try {

        if (isset($request->correo)) {
          // la variable esta instanciada
          if (empty($request->correo)) {
            // si esta vacia entonces llenar estos valores
            $message  = 'Ingrese el correo';

          } else {
            $message = 'Surgió un problema en el proceso de validación del correo';
            // buscar el usuario por el correo
            $query = User::where('email',$request->correo)->first();

            try {

              if (isset($query->email)) {// la email esta instanciada
                if (empty($query->email)) { // la clave esta vacia
                  $message = 'La correo está vacio, por favor ingrese la correo';
                } else {
                  $message = 'Problemas al validar el usuario';
                  if ($query->estado_del != '1') {
                    $message = 'Este usuario está desabilitado';
                  } else if($query->estado_del == '1'){

                    //$newItem['nome_token']  = $query->nome_token;
                    $newItem['nombre']      = $query->name;
                    $newItem['correo']      = $query->email;
                    //$newItem['clave']       = $query->password;
                    //$newItem['estado_del']  = $query->estado_del;

                    $item     = $newItem;
                    $code     = '200';
                    $message  = 'ok';
                  }

                }

              } else {// la clave no esta instanciada
                $message = 'No se ha enviado la clave al servidor, por favor ingrese la clave';
              }

            } catch (\Exception $e) {
              $message = 'El correo es invalido';
              $message_exception = $e->getMessage();
            }

          }

        } else {
          $message  = 'Ingrese el correo';
        }

      } catch (\Exception $e) {
        $message = $e->getMessage();
        $message_exception = $e->getMessage();
      }

      $respuesta = array(
        'items'             =>  $item,
        'code'              =>  $code,
        'message'           =>  $message,
        'message_exception' => $message_exception,
      );

      return response()->json($respuesta);


    }

    public function login(Request $request){
      $item     = '';
      $code     = '500';
      $message  = '';
      $message_exception = '';
      $ignorar = array("/", ".", "$");

      try {
        // if (isset($request)) { //la variable esta instanciada
        //   if (empty($request)) { //la variable esta vacia ..,
        //     $code = '500';
        //     $me
        //   } else {
        //     $code = '200';
        //     $message = 'ok';
        //   }
        // } else {
        //   $code = '500';
        //   $message = 'variable no esta instanciada';
        // }

        // $newItem = [
        //   'nombre' => '',
        //   'correo' => '',
        //   'clave'  => '',
        //   'estado_del' => '',
        // ];
        if (isset($request->correo)) {
          // la variable esta instanciada
          if (empty($request->correo)) {
            // si esta vacia entonces llenar estos valores
            $message  = 'Ingrese el correo';

          } else {
            $message = 'Surgió un problema en el proceso de validación del correo';
            // buscar el usuario por el correo
            $query = User::where('email',$request->correo)->first();

            try {

              if (isset($request->clave)) {// la clave esta instanciada
                if (empty($request->clave)) { // la clave esta vacia
                  $message = 'La clave está vacia, por favor ingrese la clave';
                } else {
                  $message = 'Problemas al validar la clave del usuario';
                  if ($request->clave != $query->password2) {
                    $message = 'La clave es incorrecta';
                  } else if($request->clave == $query->password2){
                    $newItem['nome_token']  = $query->nome_token;
                    $newItem['nombre']      = $query->name;
                    $newItem['correo']      = $query->email;
                    $newItem['clave']       = $query->password;
                    $newItem['estado_del']  = $query->estado_del;

                    $item     = $newItem;
                    $code     = '200';
                    $message  = 'ok';
                  }

                }

              } else {// la clave no esta instanciada
                $message = 'No se ha enviado la clave al servidor, por favor ingrese la clave';
              }

            } catch (\Exception $e) {
              $message = 'El correo es invalido';
              $message_exception = $e->getMessage();
            }

          }

        } else {
          $message  = 'Ingrese el correo';
        }

      } catch (\Exception $e) {
        $message = $e->getMessage();
        $message_exception = $e->getMessage();
      }

      $respuesta = array(
        'items'             =>  $request->clave,
        'code'              =>  $code,
        'message'           =>  $message,
        'message_exception' => $message_exception,
      );

      return response()->json($respuesta);

    }

}
