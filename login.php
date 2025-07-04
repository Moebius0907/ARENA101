<!-- Halaman login -->
<?php
include('koneksi.php');
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password']; 

    // Ambil data user berdasarkan username saja
    $query = "SELECT id, username, password, role FROM users WHERE username='$username' LIMIT 1";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $user = mysqli_fetch_assoc($result);

   if (password_verify($password, $user['password'])) {
    $_SESSION['user_id'] = $user['id'];
    $_SESSION['username'] = $user['username'];
    $_SESSION['role'] = $user['role'];
    
    // Tambahkan session untuk notifikasi
    $_SESSION['login_success'] = true;

  // Arahkan sesuai role
  if ($user['role'] === 'admin') {
      header('Location: admin/admin_dashboard.php');
  } else {
      header('Location: users/dashboard.php');
  }
  exit();
}
    }

    // Jika login gagal
    $loginError = "Username atau password salah!";
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Login - Arena101</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
</head>
<body class="bg-gradient-to-r from-[#b2c3a3]/10 to-[#5a6a4e] flex items-center justify-center min-h-screen px-4 overflow-hidden relative">

  <!-- Tombol Kembali -->
  <a href="index.php" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition" title="Kembali ke Beranda">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-gray-700" viewBox="0 0 16 16">
      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
    </svg>
  </a>

  <!-- Gambar Samping Form Login -->
  <div id="loginContainer" class="transition-transform duration-500 transform bg-white rounded-lg shadow-md flex w-full max-w-4xl overflow-hidden">
    <div class="hidden md:block w-[45%] relative">
      <img src="img/arena.jpg" class="h-full w-full object-cover hover:animate-pulse rounded-l-lg">
      <div class="absolute inset-0 flex flex-col items-center justify-center bg-black bg-opacity-40 text-white text-center p-4">
        <h1 class="text-3xl font-bold mb-2">Selamat Datang!</h1>
        <h2 class="text-xl text-[#b2c3a3] font-bold">Arena101</h2>
      </div>
    </div>

    <!-- Form Login -->
    <div class="w-full md:w-[55%] p-10">
      <h1 class="text-2xl font-bold text-[#5a6a4e] mb-6 text-center">Login</h1>

      <?php if (isset($loginError)): ?>
        <div id="errorMessage" class="mb-6 px-4 py-3 rounded bg-red-100 text-red-700 border border-red-300 shadow-md mx-5">
          <?= $loginError ?>
        </div>
      <?php endif; ?>

      <!-- Form -->
      <form method="POST" class="space-y-4">
        
        <!-- Username -->
        <div class="relative">
          <input type="text" name="username" placeholder="Username" required class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="fas fa-user absolute left-3 top-2.5 text-gray-500"></i>
        </div>

        <!-- Password -->
        <div class="relative">
          <input type="password" name="password" id="passwordInput" placeholder="Password" required class="w-full px-4 py-2 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="fas fa-lock absolute left-3 top-2.5 text-gray-500"></i>
          <i id="togglePassword" class="fas fa-eye absolute right-3 top-2.5 text-gray-500 cursor-pointer hover:text-[#5a6a4e]"></i>
        </div>

        <!-- Tombol Login -->
        <button type="submit" class="w-full bg-[#5a6a4e] hover:bg-[#4a5940] text-white py-2 px-4 rounded-lg shadow transition transform hover:scale-105 hover:shadow-lg active:scale-95 font-semibold">
          <i class="fas fa-sign-in-alt mr-2"></i> Login
        </button>
      </form>

      <!-- Pendaftaran -->
      <p class="text-center text-sm text-gray-600 mt-4">Belum punya akun? 
        <a href="daftar.php" class="text-[#5a6a4e] font-medium hover:underline">Daftar sekarang</a>
      </p>
    </div>
  </div>

  <script>
    window.addEventListener('DOMContentLoaded', () => {
      const errorMessage = document.getElementById('errorMessage');
      if (errorMessage) {
        // Animasi hilang setelah 3 detik
        setTimeout(() => {
          errorMessage.classList.add('opacity-0', 'transition', 'duration-500');
          setTimeout(() => {
            errorMessage.remove();
          }, 500); // Setelah 500ms (setelah animasi fade out selesai)
        }, 3000); // Notifikasi muncul selama 3 detik
      }

      // Toggle password 
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('passwordInput');
      
      togglePassword.addEventListener('click', function() {
        // Toggle tipe attribute
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        
        // Toggle icon mata buka tutup
        this.classList.toggle('fa-eye');
        this.classList.toggle('fa-eye-slash');
        
        // Ubah warna toogle
        if (type === 'text') {
          this.classList.add('text-[#5a6a4e]');
        } else {
          this.classList.remove('text-[#5a6a4e]');
        }
      });
    });
  </script>

</body>
</html>