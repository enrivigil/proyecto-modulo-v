<?php

namespace App\Models;

use CodeIgniter\Model;

class ArchivoMisionModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'archivos_mis';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'url', 'empleado_id', 'mision_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'url' => 'required',
        'empleado_id' => 'required',
        'mision_id' => 'required',
    ];
    protected $validationMessages   = [
        'url' => ['required' => 'El campo url es requerido',],
        'empleado_id' => ['required' => 'El campo empleado_id es requerido',],
        'mision_id' => ['required' => 'El campo mision_id es requerido',],
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
