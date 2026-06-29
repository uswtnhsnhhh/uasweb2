<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\SupplierModel;

class Supplier extends BaseController
{
    public function index()
    {
        $model = new SupplierModel();

        return $this->response->setJSON(
            $model->findAll()
        );
    }

    public function create()
    {
        $model = new SupplierModel();

        $data = $this->request->getJSON(true);

        $model->insert([
            'nama_supplier' => $data['nama_supplier'],
            'alamat' => $data['alamat'],
            'telepon' => $data['telepon']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Supplier berhasil ditambah'
        ]);
    }

    public function show($id)
    {
        $model = new SupplierModel();

        return $this->response->setJSON(
            $model->find($id)
        );
    }

    public function update($id)
    {
        $model = new SupplierModel();

        $model->update($id, [
            'nama_supplier' => $this->request->getRawInput()['nama_supplier'],
            'alamat' => $this->request->getRawInput()['alamat'],
            'telepon' => $this->request->getRawInput()['telepon']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Supplier berhasil diupdate'
        ]);
    }

    public function delete($id)
    {
        $model = new SupplierModel();

        $model->delete($id);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Supplier berhasil dihapus'
        ]);
    }
}