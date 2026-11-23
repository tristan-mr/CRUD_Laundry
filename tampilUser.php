<?php
session_start();
include 'koneksi.php';

// Jika halaman ini diakses melalui form login (POST)
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $status   = $_POST['status'] ?? '';
    $nama     = trim($_POST['nama'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $errorMessage = '';

    // Validasi Sisi Server
    if ($status === 'siswa') {
        $regexNamaUser = '/^[a-zA-Z\s]+$/';
        $regexPassUser = '/^[a-zA-Z0-9]+$/';

        if (!preg_match($regexNamaUser, $nama)) {
            $errorMessage = 'Nama user hanya boleh berisi HURUF!';
        } elseif (!preg_match($regexPassUser, $password)) {
            $errorMessage = 'Password user hanya boleh berisi HURUF dan ANGKA!';
        }
    } elseif ($status === 'admin') {
        if (strtolower($nama) !== 'nona' || $password !== 'nona1') {
            $errorMessage = 'Nama atau Password Admin salah! (Hanya admin yang diizinkan)';
        }
    }

    // Jika ada error, kembalikan ke index.php beserta pesannya
    if ($errorMessage !== '') {
        header('Location: index.php?error=' . urlencode($errorMessage));
        exit;
    }

    // Simpan sesi login
    $_SESSION['user_nama'] = $nama;
    $_SESSION['user_status'] = $status;

    // Jika yang login ADMIN, alihkan ke halaman laporan
    if ($status === 'admin') {
        header('Location: hasilUser.php');
        exit;
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Data Laporan</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen p-6 md:p-10">
  <div class="max-w-6xl mx-auto bg-white shadow-md rounded-xl p-6 md:p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Data User</h2>
    
    <div class="flex items-center gap-4 mb-6 text-sm">
      <a href="index.php" class="text-indigo-600 hover:text-indigo-800 font-medium">&laquo; Menu Utama</a> 
      <span class="text-gray-300">|</span> 
      <a href="tambahLaporan.php" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-4 py-2 rounded-lg shadow-sm transition">+ Tambah User Baru</a>
    </div>

    <div class="overflow-x-auto">
      <table class="w-full border-collapse bg-white text-left text-sm text-gray-500 shadow-sm border border-gray-200 rounded-lg">
        <thead class="bg-gray-100 text-gray-700 uppercase text-xs tracking-wider">
          <tr>
            <th class="p-3 border-b">No</th>
            <th class="p-3 border-b">Nis</th>
            <th class="p-3 border-b">Nama</th>
            <th class="p-3 border-b">Alamat</th>
            <th class="p-3 border-b">Barang</th>
            <th class="p-3 border-b text-center">Aksi</th>
          </tr>
        </thead>
        <tbody class="divide-y divide-gray-200">
          <?php
          $no = 1;
          $query = mysqli_query($koneksi, "SELECT * FROM tb_User"); 
          while ($data = mysqli_fetch_assoc($query)){
          ?>
          <tr class="hover:bg-gray-50 transition">
            <td class="p-3"><?= $no++; ?></td>
            <td class="p-3"><?= htmlspecialchars($data['nis']); ?></td>
            <td class="p-3"><?= htmlspecialchars($data['nama']); ?></td>
            <td class="p-3"><?= htmlspecialchars($data['alamat']); ?></td>
            <td class="p-3 font-medium text-gray-800"><?= htmlspecialchars($data['barang']); ?></td>
            <td class="p-3 text-center">
              <div class="flex flex-col sm:flex-row items-center justify-center gap-1.5">
                <a href="User_edit.php?id=<?= $data['id_user']; ?>" class="bg-amber-500 hover:bg-amber-600 text-white font-medium px-3 py-1 rounded-md shadow-sm transition text-xs">Edit</a>
                <a href="User_hapus.php?id=<?= $data['id_user']; ?>" onclick="return confirm('Yakin ingin menghapus data ini?')" class="bg-rose-600 hover:bg-rose-700 text-white font-medium px-3 py-1 rounded-md shadow-sm transition text-xs">Hapus</a>
              </div>
            </td>
          </tr>
          <?php } ?>
       </tbody>
     </table>
   </div>
  </div>
</body>
</html>
