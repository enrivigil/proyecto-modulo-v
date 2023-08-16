<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class ReportesMision extends BaseController
{
    use ResponseTrait;

    // funcion para obtener el reporte de todas la misiones por area
    // incluyendo el rango de fechas

    public function reporteArea()
    {
        try {

            $data = [
                'id' => $this->request->getVar('id'),
                'fi' => $this->request->getVar('fi'),
                'ff' => $this->request->getVar('ff'),
            ];
            
            $db = db_connect();
            $builder = $db->table('misiones');

            if (isset($data['id']))
                $builder->where('area_id', $data['id']);

            if (isset($data['fi']) && isset($data['ff']))
                $builder->where([
                    'fecha_hora_inicio >=' => $data['fi'],
                    'fecha_hora_final <=' => $data['ff'],
                ]);

            $query = $builder->get();
            $data = $query->getResult();

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            throw $e;
        }
    }

    // funcion para obtener el reporte de todas las misiones por empleado
    // incluyente el rango de fechas y el estado de la capacitacion
    public function reporteEmpleado()
    {
        try {

            $data = [
                'id' => $this->request->getVar('id'),
                'fi' => $this->request->getVar('fi'),
                'ff' => $this->request->getVar('ff'),
                'estado' => $this->request->getVar('estado'),
            ];

            $db = db_connect();
            $builder = $db->table('participantes as p');
            $builder->select('
                m.id,
                m.nombre,
                m.descripcion,
                m.estimacion,
                m.institucion,
                m.fecha_hora_inicio,
                m.fecha_hora_final,
                m.area_id,
            ');
            $builder->join('misiones as m', 'p.mision_id = m.id', 'inner');

            if (isset($data['id']))
                $builder->where('p.empleado_id', $data['id']);

            if (isset($data['fi']) && isset($data['ff']))
                $builder->where([
                    'm.fecha_hora_inicio >=' => $data['fi'],
                    'm.fecha_hora_final <=' => $data['ff'],
                ]);

            $query = $builder->get();
            $data = $query->getResult();

            return $this->respond([
                'code' => 200,
                'data' => $data,
            ]);

        } catch (\Exception $e) {
            throw $e;
        }
    }
}
