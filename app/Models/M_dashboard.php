<?php

namespace App\Models;

use CodeIgniter\Model;

class M_dashboard extends Model
{

    protected $table      = 'tb_product';
    protected $primaryKey = 'kd_product';

    protected $returnType     = 'object';
    protected $useSoftDeletes = true;

    protected $allowedFields = ['name', 'price'];

    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    protected $validationRules    = [
        'name'     => 'required|min_length[3]',
        'price'        => 'required|numeric',
    ];

    protected $validationMessages = [
        'name'        => [
            'required' => 'Bagian Name Harus diisi',
            'min_length' => 'Minimal 3 Karakter'
        ],
        'price'        => [
            'required' => 'Bagian Price Harus diisi',
            'numeric' => 'Hanya bisa diisi dengan angka'
        ]
    ];
    protected $skipValidation  = false;

    public function getData()
    {
        return 'Ini adalah Method getData didalam ProductModel';
    }
}
