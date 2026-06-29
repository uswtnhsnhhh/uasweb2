export default function handler(req, res) {
  // hanya izinkan POST
  if (req.method !== 'POST') {
    return res.status(405).json({ message: 'Method not allowed' });
  }

  const { username, password } = req.body;

  // 🔥 LOGIC LOGIN (ubah sesuai punyamu)
  if (username === 'admin' && password === '123') {
    return res.status(200).json({
      success: true,
      message: 'Login berhasil',
      user: {
        username: 'admin'
      }
    });
  }

  return res.status(401).json({
    success: false,
    message: 'Username atau password salah'
  });
}
