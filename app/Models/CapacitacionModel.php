<?php

namespace App\Models;

use CodeIgniter\Model;

class CapacitacionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'capacitaciones';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre', 'descripcion', 'institucion', 'modalidad', 'fecha_inicio', 'fecha_final',
        'cantidad_horas', 'estado', 'area_id'
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
        'descripcion' => 'required',
        'institucion' => 'required',
        'modalidad' => 'required',
        'fecha_inicio' => 'required',
        'fecha_final' => 'required',
        'cantidad_horas' => 'required',
        'estado' => 'required',
        'area_id' => 'required',
    ];
    protected $validationMessages   = [
        'nombre' => ['required' => 'El campo nombre es requerido',],
        'descripcion' => ['required' => 'El campo descripcion es requerido',],
        'institucion' => ['required' => 'El campo institucion es requerido',],
        'modalidad' => ['required' => 'El campo modalidad es requerido',],
        'fecha_inicio' => ['required' => 'El campo fecha_inicio es requerido',],
        'fecha_final' => ['required' => 'El campo fecha_final es requerido',],
        'cantidad_horas' => ['required' => 'El campo cantidad_horas es requerido',],
        'estado' => ['required' => 'El campo estado es requerido',],
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
