<template>
  <div class="min-h-screen bg-gradient-to-br from-slate-100 via-sky-50 to-slate-100 flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md overflow-hidden rounded-[2rem] bg-white p-8 shadow-2xl ring-1 ring-slate-200">
      <div class="mb-8 text-center">
        <div class="mx-auto mb-6 inline-flex h-16 w-16 items-center justify-center rounded-3xl bg-sky-600 text-white shadow-lg shadow-sky-500/20">
          <span class="text-3xl">🔐</span>
        </div>
        <h1 class="text-4xl font-semibold text-slate-900">E-Inventory</h1>
        <p class="mt-3 text-sm text-slate-600">Masuk untuk mengelola barang, supplier, dan kategori inventaris.</p>
      </div>

      <div class="space-y-5">
        <div class="space-y-2">
          <label class="block text-sm font-medium text-slate-700">Username</label>
          <input
            v-model="username"
            placeholder="admin"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
        </div>

        <div class="space-y-2">
          <label class="block text-sm font-medium text-slate-700">Password</label>
          <input
            v-model="password"
            type="password"
            placeholder="••••••••"
            class="w-full rounded-2xl border border-slate-200 bg-slate-50 px-4 py-3 text-slate-900 placeholder:text-slate-400 shadow-sm outline-none transition duration-200 focus:border-sky-400 focus:ring-2 focus:ring-sky-200"
          />
        </div>

        <button
          @click="login"
          class="w-full rounded-2xl bg-sky-600 py-3.5 text-sm font-semibold text-white shadow-lg shadow-sky-500/20 transition duration-200 hover:bg-sky-700 hover:-translate-y-0.5"
        >
          Masuk
        </button>
      </div>
    </div>
  </div>
</template>

<script setup>
import api from '@/services/api'
import { ref } from 'vue'
import { useRouter } from 'vue-router'

const username = ref('')
const password = ref('')
const router = useRouter()

const login = async () => {
  try {
    const response = await api.post('/login', {
      username: username.value,
      password: password.value,
    })

    alert('Login Berhasil')

    localStorage.setItem('token', response.data.token)
    localStorage.setItem('isLoggedIn', 'true')
    router.push('/dashboard')
  } catch (err) {
    alert('Login Gagal')
  }
}
</script>
