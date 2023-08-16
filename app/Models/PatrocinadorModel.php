<?php

namespace App\Models;

use CodeIgniter\Model;

class PatrocinadorModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'patrocinadores';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'institucion', 'descripcion', 'capacitacion_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'institucion' => 'required',
        'descripcion' => 'required',
        'capacitacion_id' => 'required',
    ];
    protected $validationMessages   = [
        'institucion' => ['required' => 'El campo institucion es requerido',],
        'descripcion' => ['required' => 'El campo descripcion es requerido',],
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
