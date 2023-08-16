<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ArchivoCapacitacionModel;
use CodeIgniter\API\ResponseTrait;

class ArchivosCapacitacion extends BaseController
{
    use ResponseTrait;

    public function index($capacitacionId)
    {
        try {

            $model = model(ArchivoCapacitacionModel::class);
            $data = $model
                ->where('capacitacion_id', $capacitacionId)
                ->findAll();

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create($capacitacionId)
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
                'capacitacion_id' => $this->request->getPost('capacitacion_id'),
            ];

            $model = model(ArchivoCapacitacionModel::class);

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

    public function show($capacitacionId, $id)
    {
        try {

            $model = model(ArchivoCapacitacionModel::class);
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

    public function update($capacitacionId, $id)
    {
        try {

            $model = model(ArchivoCapacitacionModel::class);
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
                'capacitacion_id' => $this->request->getPost('capacitacion_id'),
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

    public function delete($capacitacionId, $id)
    {
        try {

            $model = model(ArchivoCapacitacionModel::class);
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
