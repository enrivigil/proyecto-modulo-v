<?php

namespace App\Models;

use CodeIgniter\Model;

class UsuarioModel extends Model
{
    protected $DBGroup          = 'default';
    protected $table            = 'usuarios';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $insertID         = 0;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'nom_usuario', 'contrasenia', 'activo', 'empleado_id',
    ];

    // Dates
    protected $useTimestamps = false;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [
        'nom_usuario' => 'required|is_unique[usuarios.nom_usuario]',
        'contrasenia' => 'required',
        'activo' => 'required',
        'empleado_id' => 'required',
    ];
    protected $validationMessages   = [
        'nom_usuario' => [
            'required' => 'El campo nom_usuario es requerido',
            'is_unique' => 'El nombre de usuario ya existe. Elige otro',
        ],
        'contrasenia' => ['required' => 'El campo contrasenia es requerido',],
        'activo' => ['required' => 'El campo activo es requerido',],
        'empleado_id' => ['required' => 'El campo empleado_id es requerido',],
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
