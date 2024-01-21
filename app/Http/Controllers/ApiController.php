<?php

namespace App\Http\Controllers;

use App\Models\Carta;
use App\Models\Expansion;
use App\Models\Rareza;
use App\Models\Tipo;
use App\Models\User;
use Exception;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{

    // TODAS LAS CARTAS PARA N USUARIO
    public function index() {
        try {
            $cartas = Carta::where('user_id', auth()->user()->id)->get();
            return self::controlEstadoCartas(200, 'Consulta exitosa.', $cartas);
        } catch (Exception $e) {
            return self::controlEstadoCartas(500, 'Error al realizar la consulta.');
        }
        
    }

    //  CREAR UNA CARTA PARA N USUARIO
    public function create(Request $request) {
        try {
            $dataRequest = self::limpiarEspacios($request->all());
            //-- VALIDACION DE CAMPOS

            // NOMBRE
            if(!self::cadenaValido($dataRequest['name'])) {
                return self::controlEstadoCartas(601, "El name nombre de contener un minimo de 2 caracteres y un maximo de 30, sin caracteres especiales, acentos o dieresis.");
            }

            // HP
            if (!self::esMultiplo($dataRequest['hp'], 10)) {
                return self::controlEstadoCartas(602, "El hp debe ser un numero entero y multiplo de 10.");
            }

            // EXPANCIO
            $expansion = Expansion::where('tipo_expansion', $dataRequest['expansion'])->get();
            
            if(count($expansion) != 1) {
                return self::controlEstadoCartas(603, "La expansion no es correcta.");
            }

            $expansion = json_decode($expansion)[0];

            // TIPO
            $tipo = Tipo::where('type', $dataRequest['tipo'])->get();

            if(count($tipo) != 1) {
                return self::controlEstadoCartas(604, "El tipo no es correcto.");
            }

            // RAREZA
            $rareza = Rareza::where('tipo_rareza', $dataRequest['rareza'])->get();

            if(count($rareza) != 1) {
                return self::controlEstadoCartas(605, "La rareza no es correcta.");
            }

            // PRECIO
            if (!is_int($dataRequest['precio'])) {
                return self::controlEstadoCartas(606, "El precio debe ser un numero entero.");
            }

            // URL IMAGEN
            if(!self::statusUrl($dataRequest['imagen_online'])) {
                return self::controlEstadoCartas(700, "La url no es valida o no se encuentra disponible.");
            }

            // NUEVA CARTA
            $carta = new Carta();
            $carta->user_id = auth()->user()->id;
            $carta->name = $dataRequest['name'];
            $carta->hp = $dataRequest['hp'];
            $carta->es_primera_edicion = $expansion->es_primera_edicion;
            $carta->expansion = $expansion->tipo_expansion;
            $carta->tipo = $dataRequest['tipo'];
            $carta->rareza = $dataRequest['rareza'];
            $carta->precio = $dataRequest['precio'];
            $carta->imagen_online = $dataRequest['imagen_online'];
            $carta->save();

            return self::controlEstadoCartas(200, 'Consulta exitosa.');

        } catch (Exception $e) {
            return $e;
            return self::controlEstadoCartas(500, 'Error al realizar la consulta.');
        }
        
    }

    //  DEVOLVER UNA CARTA RELACIONADA A N USUARIO
    public function show(Request $request) {
        try {
            $dataRequest = self::limpiarEspacios($request->all());

            // ID
            if(!is_int($dataRequest['id'])) {
                return self::controlEstadoCartas(607, "Id incorrecto, requiere un valor entero.");
            }

            $carta = Carta::where(['user_id' => auth()->user()->id, 'id' => $dataRequest['id']])->get();

            return self::controlEstadoCartas(200, 'Consulta exitosa.', $carta);

        } catch (Exception $e) {
            return self::controlEstadoCartas(500, 'Error al realizar la consulta.');
        }
        
    }

    //  ACTUALIZAR N CARTA POR SU ID
    public function update(Request $request) {
        try {
            $dataRequest = self::limpiarEspacios($request->all());

            //-- VALIDACION DE CAMPOS

            // ID
            if(!is_int($dataRequest['id'])) {
                return self::controlEstadoCartas(608, "Id incorrecto, requiere un valor entero.");
            }

            // NOMBRE
            if(!self::cadenaValido($dataRequest['name'])) {
                return self::controlEstadoCartas(609, "El name nombre de contener un minimo de 2 caracteres y un maximo de 30, sin caracteres especiales, acentos o dieresis.");
            }

            // HP
            if (!self::esMultiplo($dataRequest['hp'], 10)) {
                return self::controlEstadoCartas(610, "El hp debe ser un numero entero y multiplo de 10.");
            }

            // EXPANCIO
            $expansion = Expansion::where('tipo_expansion', $dataRequest['expansion'])->get();
            
            if(count($expansion) != 1) {
                return self::controlEstadoCartas(611, "La expansion no es correcta.");
            }

            $expansion = json_decode($expansion)[0];

            // TIPO
            $tipo = Tipo::where('type', $dataRequest['tipo'])->get();

            if(count($tipo) != 1) {
                return self::controlEstadoCartas(612, "El tipo no es correcto.");
            }

            // RAREZA
            $rareza = Rareza::where('tipo_rareza', $dataRequest['rareza'])->get();

            if(count($rareza) != 1) {
                return self::controlEstadoCartas(613, "La rareza no es correcta.");
            }

            // PRECIO
            if (!is_int($dataRequest['precio'])) {
                return self::controlEstadoCartas(614, "El precio debe ser un numero entero.");
            }

            // URL IMAGEN
            if(!self::statusUrl($dataRequest['imagen_online'])) {
                return self::controlEstadoCartas(701, "La url no es valida o no se encuentra disponible.");
            }

            $carta = Carta::where(['user_id' => auth()->user()->id, 'id' => $dataRequest['id']])->first();
            $carta->name = $dataRequest['name'];
            $carta->hp = $dataRequest['hp'];
            $carta->es_primera_edicion = $expansion->es_primera_edicion;
            $carta->expansion = $expansion->tipo_expansion;
            $carta->tipo = $dataRequest['tipo'];
            $carta->rareza = $dataRequest['rareza'];
            $carta->precio = $dataRequest['precio'];
            $carta->imagen_online = $dataRequest['imagen_online'];

            $carta->save();

            return self::controlEstadoCartas(200, 'Consulta exitosa.');

        } catch (Exception $e) {
            return self::controlEstadoCartas(500, 'Error al realizar la consulta.');
        }
        
    }

    //  ELIMINAR UNA CARTA POR SU ID
    public function delete(Request $request) {
        try {
            $dataRequest = self::limpiarEspacios($request->all());

            //-- VALIDACION DE CAMPOS

            // ID
            if(!is_int($dataRequest['id'])) {
                return self::controlEstadoCartas(615, "Id incorrecto, requiere un valor entero.");
            }

            if(Carta::where('id', $dataRequest['id'])->delete()) {
                return self::controlEstadoCartas(200, 'Elimacion exitosa.');
            }

            return self::controlEstadoCartas(616, "Error al eliminar.");

        } catch (Exception $e) {
            return self::controlEstadoCartas(500, 'Error al realizar la consulta.');
        }

    }

    //---------------------------------------------------------------------------------

    // OBTENER TODOS LOS USUARIO
    public function users() {
        try {
            return self::controlUsuarios(200, 'Consulta exitosa.', User::all());

        } catch (Exception $e) {
            return self::controlUsuarios(500, 'Error al realizar la consulta.');
        }
    }

    //  LOGIN PARA N USUARIO
    public function login(Request $request) {

        try {
            $dataRequest = self::limpiarEspacios($request->all());

            // VALIDACIONES

            // EMAIL
            if(!self::emailValido($dataRequest['email'])) {
                return self::controlUsuarios(617, "Verifique el campo email.");
            }

            // PASSWORD
            if(!self::passValido($dataRequest['password'])) {
                return self::controlUsuarios(618, "Verifique el campo password.");
            }
            
            
        } catch (Exception $e) {
            return $e;
            return self::controlUsuarios(500, 'Error al realizar la consulta.');
        }


        $user = User::where('email',$dataRequest['email'])->first();

        if($user){
            if(Hash::check($dataRequest['password'],$user->password)){

                $token = $user->createToken("pokemon_api");

                return self::controlUsuarios(200, "Consulta exitosa.", $token->plainTextToken, "token");

            }else{
                return self::controlUsuarios(619, "Credenciales incorrectas.");
            }

        }else{
            return self::controlUsuarios(620, "Usuario no encontrado.");
        }

    }

    //---------------------------------------  METODOS AUXILIARES  -------------------------------------------------------------------//

    //  METODO PARA EL CONTROL DE RESPUESTA PARA LAS CARTAS
    public function controlEstadoCartas($status = 0, $msg = "", $dataset = array()) {
        $response = [
            'status' => $status,
            'msg' => $msg,
            'letter' => $dataset
        ];

        return response()->json($response);
    }

    // METODO PARA EL CONTROL DE USUARIOS
    public function controlUsuarios($status = 0, $msg = "", $dataset = array(), $label = 'users') {
        $response = [
            'status' => $status,
            'msg' => $msg,
            $label => $dataset
        ];

        return response()->json($response);
    }

    // ELIMINAR ESPACIOS EN BLANCO AL INICIO Y FINAL
    public function limpiarEspacios($data) {
        $nuevaData = array();
        foreach ($data as $key => $value) {
            if(is_string($value)) {
                $nuevaData[$key] = strtolower(trim($value));
            } else {
                $nuevaData[$key] = $value;
            }
            
        }
        return $nuevaData;
    }

    // VALIDAR CADENA DE HASTA 30 CARACTERES Y UN MINIMO DE 2, PUEDE INCLUIR ESPACIOS
    public function cadenaValido($cadena) {
        return (preg_match("/^[a-z ]{2,30}$/",$cadena) == 1);
    }

    // METODO PARA VALIDAR QUE UN ENTERO ES MULTIPLO DE N NUMERO
    public function esMultiplo($numero, $multi) {
        if(is_int($numero)) {
            return ($numero%$multi == 0);
        }
        return false;
    }

    // METODO PARA VALIDAR EMAIL
    public function emailValido($email) {
        return (preg_match("/^[a-z0-9]+[\.\-\_]{0,1}[a-z0-9]*[\.\-\_]{0,1}[a-z0-9]{1,}@[a-z0-9]+[\.]{1}[a-z]{2,3}[\.]{0,1}[a-z]{0,2}$/", $email) == 1);
    }

    // METODO PARA PASSWORD ALFANUMERICO  4 A 30 CARACTERES
    public function passValido($pass) {
        return (preg_match("/^[a-z0-9]{4,30}$/", $pass) == 1);
    }

    // METODO PARA VALIDAR URL ACTIVA
    public function statusUrl($url) {
        if(preg_match("/^https/", $url) == 1) {
            $headers = get_headers($url);
            $httpCode = intval(substr($headers[0], 9, 3));
            return $httpCode == 200;
        }
        return false;
    }
    
}
