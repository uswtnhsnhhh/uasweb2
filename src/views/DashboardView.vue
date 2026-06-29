<template>
  <div class="min-h-screen bg-slate-100 p-6 md:p-10">
    <div class="max-w-6xl mx-auto space-y-8">
      <div class="rounded-[2rem] bg-white p-8 shadow-2xl ring-1 ring-slate-200">
        <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
          <div class="space-y-3">
            <p class="text-sm font-semibold uppercase tracking-[0.2em] text-sky-600">Admin Dashboard</p>
            <h1 class="text-4xl font-bold text-slate-900">Selamat datang di E-Inventory</h1>
            <p class="max-w-2xl text-slate-600">Kelola kategori, supplier, dan barang dengan antarmuka yang lebih bersih dan responsif.</p>
          </div>

          <div class="inline-flex items-center gap-3 rounded-3xl border border-slate-200 bg-slate-50 px-5 py-4">
            <span class="text-2xl">👋</span>
            <div>
              <p class="text-sm text-slate-500">Siap bekerja</p>
              <p class="font-semibold text-slate-900">Tingkatkan inventaris Anda sekarang</p>
            </div>
          </div>
        </div>
      </div>

      <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
        <router-link
          to="/dashboard"
          class="group rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition duration-200 hover:-translate-y-1 hover:shadow-xl"
        >
          <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-600 shadow-sm">
            <span class="text-xl">📊</span>
          </div>
          <p class="mt-6 text-sm font-medium text-slate-500">Dashboard</p>
          <h2 class="mt-3 text-2xl font-semibold text-slate-900">Ringkasan</h2>
        </router-link>

        <router-link
          to="/kategori"
          class="group rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition duration-200 hover:-translate-y-1 hover:shadow-xl"
        >
          <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-600 shadow-sm">
            <span class="text-xl">📁</span>
          </div>
          <p class="mt-6 text-sm font-medium text-slate-500">Kategori</p>
          <h2 class="mt-3 text-2xl font-semibold text-slate-900">Kelola Kategori</h2>
        </router-link>

        <router-link
          to="/supplier"
          class="group rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition duration-200 hover:-translate-y-1 hover:shadow-xl"
        >
          <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-600 shadow-sm">
            <span class="text-xl">🏢</span>
          </div>
          <p class="mt-6 text-sm font-medium text-slate-500">Supplier</p>
          <h2 class="mt-3 text-2xl font-semibold text-slate-900">Kelola Supplier</h2>
        </router-link>

        <router-link
          to="/barang"
          class="group rounded-3xl bg-white p-6 shadow-sm ring-1 ring-slate-200 transition duration-200 hover:-translate-y-1 hover:shadow-xl"
        >
          <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-600 shadow-sm">
            <span class="text-xl">📦</span>
          </div>
          <p class="mt-6 text-sm font-medium text-slate-500">Barang</p>
          <h2 class="mt-3 text-2xl font-semibold text-slate-900">Kelola Stok</h2>
        </router-link>

        <button
          @click="logout"
          class="group rounded-3xl bg-white p-6 text-left shadow-sm ring-1 ring-slate-200 transition duration-200 hover:-translate-y-1 hover:shadow-xl"
        >
          <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700 shadow-sm">
            <span class="text-xl">🔓</span>
          </div>
          <p class="mt-6 text-sm font-medium text-slate-500">Logout</p>
          <h2 class="mt-3 text-2xl font-semibold text-slate-900">Keluar</h2>
        </button>
      </div>

      <div class="rounded-3xl bg-white p-6 shadow-2xl ring-1 ring-slate-200">
        <h2 class="text-xl font-semibold text-slate-900 mb-3">Petunjuk</h2>
        <p class="text-slate-600 leading-7">Pilih menu kategori, supplier, atau barang untuk melihat dan mengelola data inventaris. Tombol logout akan menghapus sesi dan membawa Anda kembali ke halaman login.</p>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useRouter } from 'vue-router'

const router = useRouter()

const logout = () => {
  localStorage.removeItem('token')
  localStorage.removeItem('isLoggedIn')
  router.replace('/login')
}
</script>
