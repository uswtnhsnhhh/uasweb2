<?php

namespace App\Controllers\Api;

use App\Controllers\BaseController;
use App\Models\KategoriModel;

class Kategori extends BaseController
{
    protected $kategori;

    public function __construct()
    {
        $this->kategori = new KategoriModel();
    }

    // GET semua kategori
    public function index()
    {
        return $this->response->setJSON(
            $this->kategori->findAll()
        );
    }

    // POST tambah kategori (FIX JSON)
    public function create()
    {
        $data = $this->request->getJSON(true);

        $this->kategori->insert([
            'nama_kategori' => $data['nama_kategori']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Kategori berhasil ditambah'
        ]);
    }

    // GET by id
    public function show($id)
    {
        return $this->response->setJSON(
            $this->kategori->find($id)
        );
    }

    // PUT / UPDATE
    public function update($id)
    {
        $data = $this->request->getJSON(true);

        $this->kategori->update($id, [
            'nama_kategori' => $data['nama_kategori']
        ]);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Kategori berhasil diupdate'
        ]);
    }

    // DELETE
    public function delete($id)
    {
        $this->kategori->delete($id);

        return $this->response->setJSON([
            'status' => true,
            'message' => 'Kategori berhasil dihapus'
        ]);
    }
}
