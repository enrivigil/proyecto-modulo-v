<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\PatrocinadorModel;
use CodeIgniter\API\ResponseTrait;

class Patrocinadores extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {

            $model = model(PatrocinadorModel::class);
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
                'institucion' => $this->request->getVar('institucion'),
                'descripcion' => $this->request->getVar('descripcion'),
                'capacitacion_id' => $this->request->getVar('capacitacion_id'),
            ];

            $model = model(PatrocinadorModel::class);

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

            $model = model(PatrocinadorModel::class);
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

            $model = model(PatrocinadorModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no econtrado',
                ], 404);

            $newdata = [
                'id' => $this->request->getVar('id'),
                'institucion' => $this->request->getVar('institucion'),
                'descripcion' => $this->request->getVar('descripcion'),
                'capacitacion_id' => $this->request->getVar('capacitacion_id'),
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

            $model = model(PatrocinadorModel::class);
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
