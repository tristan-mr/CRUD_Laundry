<?php
include 'koneksi.php';

$err_msg = "";

if (isset($_POST['submit'])) {
    $nis    = trim($_POST['nis'] ?? '');
    $nama   = trim($_POST['nama'] ?? '');
    $alamat = trim($_POST['alamat'] ?? '');
    $barang = trim($_POST['barang'] ?? '');

    // Validasi sederhana
    if (empty($nis) || empty($nama) || empty($alamat) || empty($barang)) {
        $err_msg = "Semua kolom wajib diisi!";
    } else {
        // Mencegah SQL Injection
        $nis_esc    = mysqli_real_escape_string($koneksi, $nis);
        $nama_esc   = mysqli_real_escape_string($koneksi, $nama);
        $alamat_esc = mysqli_real_escape_string($koneksi, $alamat);
        $barang_esc = mysqli_real_escape_string($koneksi, $barang);

        $query = "INSERT INTO tb_User (nis, nama, alamat, barang) VALUES ('$nis_esc', '$nama_esc', '$alamat_esc', '$barang_esc')";
        
        if (mysqli_query($koneksi, $query)) {
            header("Location: tampilUser.php");
            exit;
        } else {
            $err_msg = "Gagal menyimpan data: " . mysqli_error($koneksi);
        }
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah User Baru</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen p-6 md:p-10">
  <div class="max-w-xl mx-auto bg-white shadow-md rounded-xl p-6 md:p-8">
    <h2 class="text-2xl font-bold mb-6 text-gray-800 border-b pb-3">Tambah User Baru</h2>

    <?php if (!empty($err_msg)): ?>
      <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4 text-sm">
        <?= htmlspecialchars($err_msg); ?>
      </div>
    <?php endif; ?>

    <form action="" method="POST" class="space-y-4">
      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">NIS</label>
        <input type="text" name="nis" value="<?= htmlspecialchars($_POST['nis'] ?? ''); ?>" required
          class="w-full rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
        <input type="text" name="nama" value="<?= htmlspecialchars($_POST['nama'] ?? ''); ?>" required
          class="w-full rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Alamat</label>
        <textarea name="alamat" rows="3" required
          class="w-full rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500 resize-none"><?= htmlspecialchars($_POST['alamat'] ?? ''); ?></textarea>
      </div>

      <div>
        <label class="block text-sm font-medium text-gray-700 mb-1">Barang</label>
        <input type="text" name="barang" value="<?= htmlspecialchars($_POST['barang'] ?? ''); ?>" required
          class="w-full rounded-lg border border-gray-300 p-2.5 focus:outline-none focus:ring-2 focus:ring-indigo-500">
      </div>

      <div class="flex items-center justify-between pt-4">
        <a href="tampilUser.php" class="text-gray-600 hover:text-gray-800 text-sm font-medium">&laquo; Kembali</a>
        <button type="submit" name="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-medium px-5 py-2.5 rounded-lg shadow-sm transition">
          Simpan Data
        </button>
      </div>
    </form>
  </div>
</body>
</html>
