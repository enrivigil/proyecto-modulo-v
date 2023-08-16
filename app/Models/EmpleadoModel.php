<?php

namespace App\Models;

use CodeIgniter\Model;

class EmpleadoModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'empleados';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre', 'apellido', 'profesion', 'activo', 'rol_id', 'area_id',
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
        'apellido' => 'required',
        'profesion' => 'required',
        'activo' => 'required',
        'rol_id' => 'required',
        'area_id' => 'required',
    ];
    protected $validationMessages   = [
        'nombre' => ['required' => 'El campo nombre es requerido',],
        'apellido' => ['required' => 'El campo apellido es requerido',],
        'profesion' => ['required' => 'El campo profesion es requerido',],
        'activo' => ['required' => 'El campo activo es requerido',],
        'rol_id' => ['required' => 'El campo rol_id es requerido',],
        'area_id' => ['required' => 'El campo area_id es requerido',],
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
