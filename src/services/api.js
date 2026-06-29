import axios from 'axios'

let router = null

export function setRouter(r) {
  router = r
}

/**
 * GANTI INI SESUAI BACKEND HOSTING KAMU
 * contoh:
 * https://uas-web2-api.vercel.app/api
 * https://domainkamu.com/api
 * https://backend-kamu.000webhostapp.com/api
 */
const API_BASE_URL = 'http://localhost:8080/api'

const api = axios.create({
  baseURL: API_BASE_URL,
  headers: {
    'Content-Type': 'application/json'
  }
})

api.interceptors.request.use(
  (config) => {
    const token = localStorage.getItem('token')
    if (token) {
      config.headers = config.headers || {}
      config.headers.Authorization = `Bearer ${token}`
    }
    return config
  },
  (error) => Promise.reject(error)
)

api.interceptors.response.use(
  (response) => response,
  (error) => {
    if (error.response && error.response.status === 401) {
      alert('Sesi login telah berakhir. Silakan login kembali.')
      localStorage.removeItem('token')
      localStorage.removeItem('isLoggedIn')

      if (router) {
        router.push('/login')
      } else {
        window.location.replace('/login')
      }
    }

    return Promise.reject(error)
  }
)

export default api