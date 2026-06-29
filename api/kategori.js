let kategori = [
  { id: 1, nama: "Makanan" },
  { id: 2, nama: "Minuman" }
];

export default function handler(req, res) {
  if (req.method === 'GET') {
    return res.json(kategori);
  }

  if (req.method === 'POST') {
    const { nama } = req.body;

    const newData = {
      id: kategori.length + 1,
      nama
    };

    kategori.push(newData);

    return res.status(201).json(newData);
  }

  return res.status(405).json({ message: 'Method not allowed' });
}
