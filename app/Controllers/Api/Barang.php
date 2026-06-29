<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\BarangModel;

class Barang extends BaseController
{
    public function index()
    {
        $model = new BarangModel();

        return $this->response->setJSON(
            $model->findAll()
        );
    }

   public function create()
    {
        $model = new BarangModel();

        $data = $this->request->getJSON(true);

        $model->insert([
            'nama_barang' => $data['nama_barang'],
            'stok' => $data['stok'],
            'harga' => $data['harga'],
            'kategori_id' => $data['kategori_id'],
            'supplier_id' => $data['supplier_id']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Barang berhasil ditambah'
        ]);
    }

    public function show($id)
    {
        $model = new BarangModel();

        return $this->response->setJSON(
            $model->find($id)
        );
    }

    public function update($id)
    {
        $model = new BarangModel();

        $data = $this->request->getRawInput();

        $model->update($id, [
            'nama_barang' => $data['nama_barang'],
            'stok' => $data['stok'],
            'harga' => $data['harga'],
            'kategori_id' => $data['kategori_id'],
            'supplier_id' => $data['supplier_id']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Barang berhasil diupdate'
        ]);
    }

    public function delete($id)
    {
        $model = new BarangModel();

        $model->delete($id);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Barang berhasil dihapus'
        ]);
    }
}