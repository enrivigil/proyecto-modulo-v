<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\ComentarioModel;
use CodeIgniter\API\ResponseTrait;

class Comentarios extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {

            $model = model(ComentarioModel::class);
            $data = $model->findAll();

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function create()
    {
        try {

            $data = [
                'texto' => $this->request->getVar('texto'),
                'empleado_id' => $this->request->getVar('empleado_id'),
                'mision_id' => $this->request->getVar('mision_id'),
            ];

            $model = model(ComentarioModel::class);

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

    public function show($id)
    {
        try {

            $model = model(ComentarioModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no econtrado',
                ], 404);

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function update($id)
    {
        try {

            $model = model(ComentarioModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no econtrado',
                ], 404);

            $newdata = [
                'id' => $this->request->getVar('id'),
                'texto' => $this->request->getVar('texto'),
                'empleado_id' => $this->request->getVar('empleado_id'),
                'mision_id' => $this->request->getVar('mision_id'),
            ];

            if (!$model->update($newdata['id'], $newdata))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $model->errors(),
                ], 400);

            return $this->respond([
                'code' => 200,
                'msg' => 'Datos editados con exito',
            ], 200);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function delete($id)
    {
        try {

            $model = model(ComentarioModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no econtrado',
                ], 404);

            if (!$model->delete($data['id']))
                return $this->respond([
                    'code' => 400,
                    'msg' => 'Algo ha fallado',
                    'errores' => $model->errors(),
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
