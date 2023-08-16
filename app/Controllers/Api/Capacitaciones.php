<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\CapacitacionModel;
use CodeIgniter\API\ResponseTrait;

class Capacitaciones extends BaseController
{
    use ResponseTrait;

    public function index()
    {
        try {

            $model = model(CapacitacionModel::class);
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
                'institucion' => $this->request->getVar('institucion'),
                'modalidad' => $this->request->getVar('modalidad'),
                'fecha_inicio' => $this->request->getVar('fecha_inicio'),
                'fecha_final' => $this->request->getVar('fecha_final'),
                'cantidad_horas' => $this->request->getVar('cantidad_horas'),
                'estado' => $this->request->getVar('estado'),
                'area_id' => $this->request->getVar('area_id'),
            ];

            $model = model(CapacitacionModel::class);

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

            $model = model(CapacitacionModel::class);
            $data = $model->find($id);

            // patrocinadores de la capacitacion
            $m = model(\App\Models\PatrocinadorModel::class);
            $patrocinadores = $m->where('capacitacion_id', $data['id'])->findAll();
            $data['patrocinadores'] = $patrocinadores;

            // empleados que recibieron la capacitacion
            $db = db_connect();
            $builder = $db->table('inscripciones as i');
            $builder->select('
                e.id,
                e.nombre,
                e.apellido,
                e.profesion,
                i.estado
            ');
            $builder->join('empleados as e', 'i.empleado_id = e.id', 'inner');
            $builder->where('capacitacion_id', $data['id']);
            $query = $builder->get();
            $result = $query->getResult();
            $data['empleados'] = $result;

            // archivos sobre la mision
            $m = model(\App\Models\ArchivoMisionModel::class);
            $files = $m->where('mision_id', $data['id'])->findAll();
            $data['archivos'] = $files;

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

            $model = model(CapacitacionModel::class);
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
                'institucion' => $this->request->getVar('institucion'),
                'modalidad' => $this->request->getVar('modalidad'),
                'fecha_inicio' => $this->request->getVar('fecha_inicio'),
                'fecha_final' => $this->request->getVar('fecha_final'),
                'cantidad_horas' => $this->request->getVar('cantidad_horas'),
                'estado' => $this->request->getVar('estado'),
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

            $model = model(CapacitacionModel::class);
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
