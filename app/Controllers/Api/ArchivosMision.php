<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ArchivoMisionModel;
use CodeIgniter\API\ResponseTrait;

class ArchivosMision extends BaseController
{
    use ResponseTrait;

    public function index($misionId)
    {
        try {

            $model = model(ArchivoMisionModel::class);
            $data = $model
                ->where('mision_id', $misionId)
                ->findAll();

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create($misionId)
    {
        try {

            $reglas = [
                'archivo' => 'uploaded[archivo]|max_size[archivo,5000]',
            ];

            $mensajes = [
                'archivo' => [
                    'uploaded' => 'El archivo es requerido',
                    'max_size' => 'El maximo del archivo debe ser de 5mb'
                ],
            ];

            if (!$this->validate($reglas, $mensajes))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $this->validator->getErrors(),
                ], 400);

            $archivo = $this->request->getFile('archivo');

            helper('files');
            $url = subirArchivo($archivo);

            $data = [
                'url' => $url,
                'empleado_id' => $this->request->getPost('empleado_id'),
                'mision_id' => $this->request->getPost('mision_id'),
            ];

            $model = model(ArchivoMisionModel::class);

            if (!$model->insert($data))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $model->errors(),
                ]);

            return $this->respond([
                'code' => 201,
                'msg' => 'Datos registrados con exito',
            ], 201);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function show($misionId, $id)
    {
        try {

            $model = model(ArchivoMisionModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no encontrado',
                ], 404);

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($misionId, $id)
    {
        try {

            $model = model(ArchivoMisionModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no encontrado',
                ], 404);

            $reglas = [
                'archivo' => 'uploaded[archivo]|max_size[archivo,5000]',
            ];

            $mensajes = [
                'archivo' => [
                    'uploaded' => 'El archivo es requerido',
                    'max_size' => 'El maximo del archivo debe ser de 5mb'
                ],
            ];

            if (!$this->validate($reglas, $mensajes))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $this->validator->getErrors(),
                ], 400);

            helper('files');
            eliminarArchivo($data['url']);

            $archivo = $this->request->getFile('archivo');
            $url = subirArchivo($archivo);

            $newdata = [
                'id' => $this->request->getPost('id'),
                'url' => $url,
                'empleado_id' => $this->request->getPost('empleado_id'),
                'mision_id' => $this->request->getPost('mision_id'),
            ];

            if (!$model->update($newdata['id'], $newdata))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $model->errors(),
                ]);

            return $this->respond([
                'code' => 200,
                'msg' => 'Datos editados con exito',
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($misionId, $id)
    {
        try {

            $model = model(ArchivoMisionModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no encontrado',
                ], 404);

            helper('files');
            eliminarArchivo($data['url']);

            if (!$model->delete($id))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                ], 400);

            return $this->respond([
                'code' => 200,
                'msg' => 'Datos eliminados con exito',
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
