<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Aplikasi Laundry Pakaian</title>
    <!-- Tailwind CSS CDN -->
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
</head>
<body class="bg-gray-50 text-gray-800 font-sans min-h-screen flex items-center justify-center p-6">
    <div class="max-w-md w-full bg-white shadow-md rounded-xl p-8">
        <div class="text-center mb-6">
            <h1 class="text-2xl font-bold text-gray-800">Login Sistem</h1>
            <p class="text-gray-500 text-sm mt-1">Aplikasi Laundry Pakaian</p>
        </div>

        <!-- Menampilkan Pesan Error dari Server PHP (jika ada) -->
        <?php if (isset($_GET['error'])): ?>
            <div class="mb-4 p-3 bg-red-100 border border-red-400 text-red-700 text-sm rounded-lg">
                <?= htmlspecialchars($_GET['error']); ?>
            </div>
        <?php endif; ?>

        <!-- Form langsung dikirim ke tampilLaporan.php tanpa JavaScript -->
        <form action="tampilUser.php" method="POST">
            
            <!-- Pilihan Status (Model Titik Bulat) -->
            <div class="mb-4">
                <label class="block text-sm font-medium text-gray-700 mb-2">Pilih Status Login</label>
                <div class="flex items-center space-x-6">
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="status" value="siswa" checked 
                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-gray-700">User</span>
                    </label>
                    <label class="flex items-center space-x-2 cursor-pointer">
                        <input type="radio" name="status" value="admin" 
                            class="w-4 h-4 text-indigo-600 border-gray-300 focus:ring-indigo-500">
                        <span class="text-sm font-medium text-gray-700">Admin</span>
                    </label>
                </div>
            </div>

            <!-- Nama -->
            <div class="mb-4">
                <label for="nama" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                <input type="text" id="nama" name="nama" placeholder="Masukkan nama..." required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Password -->
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-gray-700 mb-1">Password</label>
                <input type="password" id="password" name="password" placeholder="Masukkan password..." required
                    class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500">
            </div>

            <!-- Tombol Submit -->
            <button type="submit" 
                class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-medium py-2.5 px-4 rounded-lg shadow-sm transition duration-150 ease-in-out cursor-pointer">
                Masuk / Login
            </button>
        </form>
    </div>
</body>
</html>
