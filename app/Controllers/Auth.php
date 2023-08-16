<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UsuarioModel;
use CodeIgniter\API\ResponseTrait;

class Auth extends BaseController
{
    use ResponseTrait;

    public function login()
    {
        try {

            $reglas = [
                'nom_usuario' => 'required',
                'contrasenia' => 'required'
            ];

            $mensajes = [
                'nom_usuario' => [
                    'required' => 'El campo nom_usuario es requerido',
                ],
                'contrasenia' => [
                    'required' => 'El campo contrasenia es requerido',
                ],
            ];

            if (!$this->validate($reglas, $mensajes))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $this->validator->getErrors(),
                ], 400);

            $data = [
                'nom_usuario' => $this->request->getVar('nom_usuario'),
                'contrasenia' => $this->request->getVar('contrasenia'),
            ];

            $model = model(UsuarioModel::class);
            $usuario = $model->where('nom_usuario', $data['nom_usuario'])->first();

            if (!isset($usuario))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'El usuario no existe',
                ], 404);

            if ($usuario['activo'] != 1)
                return $this->respond([
                    'code' => 401,
                    'msg' => 'El usuario esta desactivado',
                ], 401);

            $pass = $data['contrasenia'];
            $hash = $usuario['contrasenia'];

            $verified = password_verify($pass, $hash);

            if (!$verified)
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Contrasenia incorrecta',
                ], 400);

            $model = model(\App\Models\EmpleadoModel::class);
            $empleado = $model->find($usuario['empleado_id']);

            $data = [
                'usuario_id' => $usuario['id'],
                'empleado_id' => $usuario['empleado_id'],
                'area_id' => $empleado['area_id'],
                'rol_id' => $empleado['rol_id'],
                'nombre' => $empleado['nombre'] . ' ' . $empleado['apellido'],
                'nom_usuario' => $usuario['nom_usuario'],
            ];

            helper('jwt');
            $jwt = makeJWT($data);

            session()->set($data);
            
            return $this->respond([
                'code' => 200,
                'data' => [
                    'usuario_id' => $usuario['id'],
                    'empleado_id' => $usuario['empleado_id'],
                    'area_id' => $empleado['area_id'],
                    'rol_id' => $empleado['rol_id'],
                    'nombre' => $empleado['nombre'] . ' ' . $empleado['apellido'],
                    'nom_usuario' => $usuario['nom_usuario'],
                    'token' => $jwt,
                ],
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
