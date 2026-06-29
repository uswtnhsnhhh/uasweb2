<template>
  <div class="min-h-screen bg-slate-100 p-6 md:p-10">
    <div class="max-w-6xl mx-auto space-y-6">
      <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
        <div>
          <h1 class="text-3xl font-bold text-slate-900">Data Kategori</h1>
          <p class="text-slate-600 mt-2">Kelola kategori barang Anda dengan antarmuka yang lebih rapi.</p>
        </div>
        <router-link to="/dashboard" class="inline-flex items-center text-slate-600 transition hover:text-slate-900">
          ← Kembali ke Dashboard
        </router-link>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <div class="flex flex-col gap-6 md:flex-row md:items-end md:justify-between">
          <div>
            <h2 class="text-xl font-semibold text-slate-900 mb-2">{{ editId ? 'Edit Kategori' : 'Tambah Kategori' }}</h2>
            <p class="text-slate-600">Gunakan form berikut untuk menambah atau mengubah data kategori.</p>
          </div>
          <div class="flex min-w-[260px] flex-col gap-3 md:w-full">
            <input
              v-model="namaKategori"
              placeholder="Nama Kategori"
              class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
            />
          </div>
        </div>

        <div class="mt-5 flex flex-wrap gap-3">
          <button
            v-if="!editId"
            @click="tambahKategori"
            class="rounded-xl bg-sky-600 px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-sky-700"
          >
            Tambah
          </button>

          <button
            v-else
            @click="updateKategori"
            class="rounded-xl bg-green-600 px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-green-700"
          >
            Update
          </button>

          <button
            v-if="editId"
            @click="batalEdit"
            class="rounded-xl bg-gray-500 px-5 py-3 text-sm font-semibold text-white transition duration-200 hover:bg-gray-600"
          >
            Batal
          </button>
        </div>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200 overflow-hidden">
        <h2 class="text-xl font-semibold text-slate-900 mb-4">Daftar Kategori</h2>
        <div class="overflow-x-auto">
          <table class="min-w-full divide-y divide-slate-200">
            <thead class="bg-slate-50">
              <tr class="text-left text-sm uppercase tracking-[0.08em] text-slate-500">
                <th class="sticky top-0 px-4 py-4">ID</th>
                <th class="sticky top-0 px-4 py-4">Nama Kategori</th>
                <th class="sticky top-0 px-4 py-4">Aksi</th>
              </tr>
            </thead>
            <tbody class="bg-white divide-y divide-slate-200">
              <tr
                v-for="item in kategori"
                :key="item.id"
                class="odd:bg-white even:bg-slate-50 hover:bg-slate-100 transition"
              >
                <td class="px-4 py-4 text-slate-700">{{ item.id }}</td>
                <td class="px-4 py-4 text-slate-900">{{ item.nama_kategori }}</td>
                <td class="px-4 py-4 space-x-2">
                  <button
                    @click="editKategori(item)"
                    class="rounded-xl bg-yellow-500 px-4 py-2 text-sm font-semibold text-white transition duration-200 hover:bg-yellow-600"
                  >
                    Edit
                  </button>
                  <button
                    @click="hapusKategori(item.id)"
                    class="rounded-xl bg-red-600 px-4 py-2 text-sm font-semibold text-white transition duration-200 hover:bg-red-700"
                  >
                    Hapus
                  </button>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>

<script setup>
import api from '@/services/api'
import { ref, onMounted } from 'vue'

const kategori = ref([])
const namaKategori = ref('')
const editId = ref(null)

const loadKategori = async () => {
  const response = await api.get('/categories')
  kategori.value = response.data
}

const tambahKategori = async () => {
  if (!namaKategori.value.trim()) {
    alert('Nama kategori tidak boleh kosong')
    return
  }

  await api.post('/categories', {
    nama_kategori: namaKategori.value
  })

  namaKategori.value = ''
  loadKategori()
}

const editKategori = (item) => {
  editId.value = item.id
  namaKategori.value = item.nama_kategori
}

const batalEdit = () => {
  editId.value = null
  namaKategori.value = ''
}

const updateKategori = async () => {
  await api.put(`/categories/${editId.value}`, {
    nama_kategori: namaKategori.value
  })

  batalEdit()
  loadKategori()
}

const hapusKategori = async (id) => {
  if (!confirm('Yakin ingin menghapus kategori ini?')) return

  await api.delete(`/categories/${id}`)
  loadKategori()
}

onMounted(() => {
  loadKategori()
})
</script>