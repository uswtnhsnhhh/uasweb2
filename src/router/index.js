import { createRouter, createWebHistory } from 'vue-router'
import LoginView from '@/views/LoginView.vue'
import DashboardView from '@/views/DashboardView.vue'
import KategoriView from '@/views/KategoriView.vue'
import SupplierView from '@/views/SupplierView.vue'
import BarangView from '@/views/BarangView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      redirect: '/dashboard'
    },
    {
      path: '/kategori',
      component: KategoriView,
      meta: { requiresAuth: true }
    },
    {
      path: '/supplier',
      component: SupplierView,
      meta: { requiresAuth: true }
    },
    {
      path: '/barang',
      component: BarangView,
      meta: { requiresAuth: true }
    },
    {
      path: '/login',
      component: LoginView
    },
    {
      path: '/dashboard',
      component: DashboardView,
      meta: { requiresAuth: true }
    }
  ]
})

router.beforeEach((to, from, next) => {
  const requiresAuth = to.meta.requiresAuth
  const isLoggedIn = localStorage.getItem('isLoggedIn') === 'true'

  if (requiresAuth && !isLoggedIn) {
    return next('/login')
  }

  next()
})

export default router
