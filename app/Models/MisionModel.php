<?php

namespace App\Models;

use CodeIgniter\Model;

class MisionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'misiones';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nombre', 'descripcion', 'estimacion', 'institucion',
        'fecha_hora_inicio', 'fecha_hora_final', 'area_id',
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
        'estimacion' => 'required',
        'institucion' => 'required',
        'fecha_hora_inicio' => 'required',
        'fecha_hora_final' => 'required',
        'area_id' => 'required',
    ];
    protected $validationMessages   = [
        'nombre' => ['required' => 'El campo nombre es requerido',],
        'descripcion' => ['required' => 'El campo descripcion es requerido',],
        'estimacion' => ['required' => 'El campo estimacion es requerido',],
        'institucion' => ['required' => 'El campo institucion es requerido',],
        'fecha_hora_inicio' => ['required' => 'El campo fecha_hora_inicio es requerido',],
        'fecha_hora_final' => ['required' => 'El campo fecha_hora_final es requerido',],
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
