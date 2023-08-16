<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use CodeIgniter\API\ResponseTrait;

class ReportesCapacitacion extends BaseController
{
    use ResponseTrait;

    // funcion para obtener el reporte de todas la capacitaciones por area
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
            $builder = $db->table('capacitaciones');

            if (isset($data['id']))
                $builder->where('area_id', $data['id']);

            if (isset($data['fi']) && isset($data['ff']))
                $builder->where([
                    'fecha_inicio >=' => $data['fi'],
                    'fecha_final <=' => $data['ff'],
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

    // funcion para obtener el reporte de todas las capacitaciones por empleado
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
            $builder = $db->table('inscripciones as i');
            $builder->select('
                c.id,
                c.nombre,
                c.descripcion,
                c.institucion,
                c.modalidad,
                c.fecha_inicio,
                c.fecha_final,
                c.cantidad_horas,
                c.estado,
                c.area_id,
            ');
            $builder->join('capacitaciones as c', 'i.capacitacion_id = c.id', 'inner');

            if (isset($data['id']))
                $builder->where('i.empleado_id', $data['id']);

            if (isset($data['fi']) && isset($data['ff']))
                $builder->where([
                    'c.fecha_inicio >=' => $data['fi'],
                    'c.fecha_final <=' => $data['ff'],
                ]);

            if (isset($data['estado']))
                $builder->where('i.estado', $data['estado']);

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
