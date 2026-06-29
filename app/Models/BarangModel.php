<?php

namespace App\Models;

use CodeIgniter\Model;

class BarangModel extends Model
{
    protected $table = 'barang';

    protected $allowedFields = [
        'nama_barang',
        'stok',
        'harga',
        'kategori_id',
        'supplier_id'
    ];
}