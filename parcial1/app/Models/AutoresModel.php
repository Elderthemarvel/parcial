<?php

namespace App\Models;

use CodeIgniter\Model;

class AutoresModel extends Model
{
    protected $table            = 'autores';
    protected $primaryKey       = 'artista_id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'array';
    protected $useSoftDeletes   = true;
    protected $protectFields    = false;
    protected $allowedFields    = [];

    protected bool $allowEmptyInserts = false;
    protected bool $updateOnlyChanged = true;

    protected array $casts = [];
    protected array $castHandlers = [];

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    // Validation
    protected $validationRules      = [];
    protected $validationMessages   = [];
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

    public function info_autores(){
        $result = $this->db->table('autores')
                    ->select('autores.artista_id, autores.nombre, autores.apellido, autores.fecha_nacimiento, autores.fecha_muerte, paises.nombre as pais')
                    ->join('paises','autores.pais_id = paises.pais_id')
                    ->where('autores.deleted_at', null)
                    ->get()
                    ->getResultArray();
        return $result;
    }



}
