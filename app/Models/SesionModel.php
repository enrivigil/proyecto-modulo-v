<?php

namespace App\Models;

use CodeIgniter\Model;

class SesionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'sesiones';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre', 'fecha_hora_inicio', 'fecha_hora_final', 'activo', 'capacitacion_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nombre' => 'required',
        'fecha_hora_inicio' => 'required',
        'fecha_hora_final' => 'required',
        'activo' => 'required',
        'capacitacion_id' => 'required',
    ];
    protected $validationMessages   = [
        'nombre' => ['required' => 'El campo nombre es requerido',],
        'fecha_hora_inicio' => ['required' => 'El campo fecha_hora_inicio es requerido',],
        'fecha_hora_final' => ['required' => 'El campo fecha_hora_final es requerido',],
        'activo' => ['required' => 'El campo activo es requerido',],
        'capacitacion_id' => ['required' => 'El campo capacitacion_id es requerido',],
    ];
    protected $skipValidation       = false;
    protected $cleanValidationRules = true;

    // Callbacks
    protected $allowCallbacks = true;
    protected $beforeInsert   = [];
    protected $afterInsert    = [];
    protected $beforeUpdate   = [];
    protected $afterUpdate    = [];
    protected $beforeFind     = [];
    protected $afterFind      = [];
    protected $beforeDelete   = [];
    protected $afterDelete    = [];
}
