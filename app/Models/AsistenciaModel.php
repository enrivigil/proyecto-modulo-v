<?php

namespace App\Models;

use CodeIgniter\Model;

class AsistenciaModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'asistencias';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'estado', 'empleado_id', 'sesion_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'estado' => 'required',
        'empleado_id' => 'required',
        'sesion_id' => 'required',
    ];
    protected $validationMessages   = [
        'estado' => ['required' => 'El campo estado es requerido',],
        'empleado_id' => ['required' => 'El campo empleado_id es requerido',],
        'sesion_id' => ['required' => 'El campo sesion_id es requerido',],
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
