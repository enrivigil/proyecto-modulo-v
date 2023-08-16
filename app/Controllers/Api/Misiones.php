<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\MisionModel;
use CodeIgniter\API\ResponseTrait;

class Misiones extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {

            $model = model(MisionModel::class);
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
                'nombre' => $this->request->getVar('nombre'),
                'descripcion' => $this->request->getVar('descripcion'),
                'estimacion' => $this->request->getVar('estimacion'),
                'institucion' => $this->request->getVar('institucion'),
                'fecha_hora_inicio' => $this->request->getVar('fecha_hora_inicio'),
                'fecha_hora_final' => $this->request->getVar('fecha_hora_final'),
                'area_id' => $this->request->getVar('area_id'),
            ];

            $model = model(MisionModel::class);

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

            $model = model(MisionModel::class);
            $data = $model->find($id);

            // empleados que participaron en la mision
            $db = db_connect();
            $builder = $db->table('participantes as p');
            $builder->select('
                e.id,
                e.nombre,
                e.apellido,
                e.profesion,
            ');
            $builder->join('empleados as e', 'p.empleado_id = e.id', 'inner');
            $builder->where('mision_id', $data['id']);
            $query = $builder->get();
            $result = $query->getResult();

            $data['empleados'] = $result;

            // comentarios sobre la mision
            $m = model(\App\Models\ComentarioModel::class);
            $comments = $m->where('mision_id', $data['id'])->findAll();

            $data['comentarios'] = $comments;

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no econtrado',
                ], 404);

            // archivos sobre la mision
            $m = model(\App\Models\ArchivoMisionModel::class);
            $files = $m->where('mision_id', $data['id'])->findAll();

            $data['archivos'] = $files;

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

            $model = model(MisionModel::class);
            $data = $model->find($id);

            if (!isset($data))
                return $this->respond([
                    'code' => 404,
                    'msg' => 'Recurso no econtrado',
                ], 404);

            $newdata = [
                'id' => $this->request->getVar('id'),
                'nombre' => $this->request->getVar('nombre'),
                'descripcion' => $this->request->getVar('descripcion'),
                'estimacion' => $this->request->getVar('estimacion'),
                'institucion' => $this->request->getVar('institucion'),
                'fecha_hora_inicio' => $this->request->getVar('fecha_hora_inicio'),
                'fecha_hora_final' => $this->request->getVar('fecha_hora_final'),
                'area_id' => $this->request->getVar('area_id'),
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

            $model = model(MisionModel::class);
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
