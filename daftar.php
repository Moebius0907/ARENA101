<!-- Halaman pendaftaran akun -->
<?php
include('koneksi.php');

// Variabel status pendaftaran
$daftarBerhasil = false;
$duplikatError = false;
$passwordTidakCocok = false;
$uploadError = false;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Sanitasi input pengguna
    $nama     = mysqli_real_escape_string($koneksi, $_POST['nama']);
    $email    = mysqli_real_escape_string($koneksi, $_POST['email']);
    $alamat   = mysqli_real_escape_string($koneksi, $_POST['alamat']);
    $username = mysqli_real_escape_string($koneksi, $_POST['username']);
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    // Validasi password
    if ($password !== $confirmPassword) {
        $passwordTidakCocok = true;
    } else {
        // Cek duplikat akun
        $cek = mysqli_query($koneksi, "SELECT * FROM users WHERE username='$username' OR email='$email'");
        
        if (mysqli_num_rows($cek) > 0) {
            $duplikatError = true;
        } else {
            // Proses upload foto profil
            $fotoName = $_FILES['foto']['name'];
            $fotoTmp  = $_FILES['foto']['tmp_name'];
            $fotoSize = $_FILES['foto']['size'];
            $folder   = 'uploads/';
            $extension = strtolower(pathinfo($fotoName, PATHINFO_EXTENSION));
            $allowedExt = ['jpg', 'jpeg', 'png', 'gif'];
            $newFileName = time() . '_' . basename($fotoName);
            $pathFoto = $folder . $newFileName;

            // Buat folder uploads jika belum ada
            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }

            // Validasi file upload
            if (!in_array($extension, $allowedExt) || $fotoSize > 2 * 1024 * 1024) {
                $uploadError = true;
            } elseif (move_uploaded_file($fotoTmp, $pathFoto)) {
                // Hash password dan simpan ke database
                $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
                $query = "INSERT INTO users (username, email, password, role, nama, alamat, foto) 
                          VALUES ('$username', '$email', '$hashedPassword', 'user', '$nama', '$alamat', '$pathFoto')";
                
                if (mysqli_query($koneksi, $query)) {
                    $daftarBerhasil = true;
                } else {
                    echo "Gagal menyimpan ke database: " . mysqli_error($koneksi);
                }
            } else {
                $uploadError = true;
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
  <!-- Metadata dan konfigurasi halaman -->
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Daftar - Arena101</title>
  
  <!-- Resource eksternal -->
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
  
  <!-- Animasi CSS -->
  <style>
    @keyframes fade-in-up {
      0% { opacity: 0; transform: translateY(20px); }
      100% { opacity: 1; transform: translateY(0); }
    }
    .animate-fade-in-up {
      animation: fade-in-up 0.6s ease-out both;
    }

    @keyframes scale-in {
      0% { transform: scale(0.8); opacity: 0; }
      100% { transform: scale(1); opacity: 1; }
    }
    .animate-scale-in {
      animation: scale-in 0.3s ease-out forwards;
    }
  </style>
  
  <!-- Konfigurasi Tailwind -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          animation: {
            'fade-in-down': 'fadeInDown 0.5s ease-out',
            'fade-in-up': 'fadeInUp 0.5s ease-out',
          },
          keyframes: {
            fadeInDown: {
              '0%': { opacity: 0, transform: 'translateY(-10px)' },
              '100%': { opacity: 1, transform: 'translateY(0)' },
            },
            fadeInUp: {
              '0%': { opacity: 0, transform: 'translateY(10px)' },
              '100%': { opacity: 1, transform: 'translateY(0)' },
            }
          }
        }
      }
    }
  </script>
</head>

<body class="bg-gradient-to-l from-[#b2c3a3] to-[#5a6a4e] min-h-screen overflow-y-auto flex items-center justify-center px-4 py-8">
  <!-- Tombol Kembali -->
  <a href="index.php" class="absolute top-4 right-4 bg-white p-2 rounded-full shadow hover:bg-gray-100 transition" title="Kembali ke Beranda">
    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="text-gray-700" viewBox="0 0 16 16">
      <path d="M2.146 2.854a.5.5 0 1 1 .708-.708L8 7.293l5.146-5.147a.5.5 0 0 1 .708.708L8.707 8l5.147 5.146a.5.5 0 0 1-.708.708L8 8.707l-5.146 5.147a.5.5 0 0 1-.708-.708L7.293 8z"/>
    </svg>
  </a>

  <!-- Container Utama -->
  <div class="bg-white max-w-4xl w-full rounded-xl shadow-lg overflow-hidden grid md:grid-cols-2 mt-4 transform transition duration-300 hover:scale-[1.01]">
    <!-- Panel Kiri: Gambar dan Informasi -->
    <div class="relative hidden md:flex flex-col bg-cover bg-center" style="background-image: url('img/arena.jpg'); background-attachment: fixed;">
      <div class="absolute inset-0 bg-black bg-opacity-50"></div>
      
      <div class="absolute inset-0 flex flex-col justify-center items-center text-white text-center p-6">
        <h1 class="text-4xl font-bold animate-fade-in-down">Selamat Datang di Arena101!</h1>
        <p class="text-lg text-[#b2c3a3] font-semibold animate-fade-in-up delay-100">Nikmati pengalaman olahraga terbaik</p>
      </div>
      
      <div class="absolute bottom-10 left-10 right-10 p-6 bg-white bg-opacity-80 rounded-lg shadow-lg text-[#5a6a4e] text-sm sm:text-base space-y-3">
        <ul class="list-disc list-inside space-y-2">
          <li><strong>Booking Mudah & Cepat</strong> - Pilih lapangan dan tentukan waktu!</li>
          <li><strong>Lapangan Berkualitas</strong> - Futsal & badminton terbaik di kelasnya.</li>
          <li><strong>Bisa Kapan Saja</strong> - Fleksibel dan mengikuti jadwal kamu.</li>
        </ul>
      </div>
    </div>

    <!-- Panel Kanan: Form Pendaftaran -->
    <div class="p-6 sm:p-10 animate-fade-in-up">
      <h2 class="text-2xl font-bold text-[#5a6a4e] text-center mb-4">Daftar Akun</h2>

      <!-- Notifikasi Status -->
      <div id="alertBox" class="text-sm text-center mb-4 
        <?php 
          echo ($duplikatError || $passwordTidakCocok || $uploadError) ? 'text-red-500' : ($daftarBerhasil ? 'text-green-500' : 'hidden'); ?>">
        <?php
          if ($duplikatError) echo "Username atau email sudah terdaftar!";
          elseif ($passwordTidakCocok) echo "Password dan konfirmasi password tidak cocok!";
          elseif ($uploadError) echo "Upload foto gagal. Gunakan JPG, PNG, atau GIF & maksimal 2MB.";
          elseif ($daftarBerhasil) echo "Pendaftaran berhasil!";
        ?>
      </div>

      <!-- Preview Foto Profil -->
      <div class="flex justify-center mb-6">
        <img id="fotoPreview" class="w-24 h-24 object-cover rounded-full hidden border-4 border-[#5a6a4e] shadow-md transition hover:scale-105" />
        <svg id="fotoPreviewSvg" class="w-24 h-24 text-gray-400 border border-gray-300 rounded-full" xmlns="http://www.w3.org/2000/svg" fill="#5a6a4e" viewBox="0 0 16 16">
          <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0"/>
          <path fill-rule="evenodd" d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1"/>
        </svg>
      </div>

      <!-- Form Pendaftaran -->
      <form method="POST" enctype="multipart/form-data" class="space-y-4">
        <!-- Field Nama Lengkap -->
        <div class="relative">
          <input type="text" name="nama" placeholder="Nama Lengkap" required 
                 class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="bi bi-person absolute left-3 top-2.5 text-gray-500"></i>
        </div>

        <!-- Field Email -->
        <div class="relative">
          <input type="email" name="email" placeholder="Email" required 
                 class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="bi bi-envelope absolute left-3 top-2.5 text-gray-500"></i>
        </div>

        <!-- Field Alamat -->
        <div class="relative">
          <textarea name="alamat" placeholder="Alamat" required 
                    class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm"></textarea>
          <i class="bi bi-house-door absolute left-3 top-3.5 text-gray-500"></i>
        </div>

        <!-- Field Username -->
        <div class="relative">
          <input type="text" name="username" placeholder="Username" required 
                 class="w-full px-4 py-2 pl-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="bi bi-person-circle absolute left-3 top-2.5 text-gray-500"></i>
        </div>

        <!-- Field Password -->
        <div class="relative">
          <input type="password" name="password" id="passwordInput" placeholder="Password" required 
                 class="w-full px-4 py-2 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="bi bi-lock absolute left-3 top-2.5 text-gray-500"></i>
          <i id="togglePassword" class="bi bi-eye absolute right-3 top-2.5 text-gray-500 cursor-pointer hover:text-[#5a6a4e]"></i>
        </div>

        <!-- Field Konfirmasi Password -->
        <div class="relative">
          <input type="password" name="confirm_password" id="confirmPasswordInput" placeholder="Konfirmasi Password" required 
                 class="w-full px-4 py-2 pl-10 pr-10 border border-gray-300 rounded-lg focus:ring-2 focus:ring-[#5a6a4e] text-sm">
          <i class="bi bi-lock-fill absolute left-3 top-2.5 text-gray-500"></i>
          <i id="toggleConfirmPassword" class="bi bi-eye absolute right-3 top-2.5 text-gray-500 cursor-pointer hover:text-[#5a6a4e]"></i>
        </div>

        <!-- Field Upload Foto -->
        <div class="relative">
          <input type="file" name="foto" accept="image/*" required onchange="previewFoto(event)" 
                 class="w-full text-sm text-gray-700 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:bg-[#b2c3a3] file:text-[#5a6a4e] hover:file:bg-[#5a6a4e]/90 hover:file:text-white transition">
        </div>

        <!-- Tombol Submit -->
        <button type="submit" class="w-full bg-[#5a6a4e] hover:bg-[#4a5940] text-white py-2 px-4 rounded-lg shadow transition transform hover:scale-105 hover:shadow-lg active:scale-95 font-semibold">
          <i class="bi bi-person-add mr-2"></i> Daftar
        </button>
      </form>

      <!-- Link Login -->
      <div class="text-center mt-4">
        <p class="text-sm text-gray-600">Sudah memiliki akun? 
          <a href="login.php" class="text-[#5a6a4e] hover:text-[#4a5940] font-semibold hover:underline">Login di sini</a>
        </p>
      </div>
    </div>
  </div>

  <!-- JavaScript untuk Fitur Tambahan -->
  <script>
    // Fungsi untuk menampilkan preview foto
    function previewFoto(event) {
      const input = event.target;
      const preview = document.getElementById('fotoPreview');
      const svgPreview = document.getElementById('fotoPreviewSvg');
      const file = input.files[0];

      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          preview.src = e.target.result;
          preview.classList.remove("hidden");
          preview.classList.add("animate-scale-in");
          svgPreview.classList.add("hidden");
        };
        reader.readAsDataURL(file);
      } else {
        preview.classList.add("hidden");
        svgPreview.classList.remove("hidden");
      }
    }

    // Inisialisasi saat halaman dimuat
    window.onload = function() {
      // Auto-hide notifikasi setelah 3.5 detik
      const alertBox = document.getElementById("alertBox");
      if (alertBox && alertBox.textContent !== "") {
        setTimeout(function() {
          alertBox.classList.add("hidden");
        }, 3500);
      }

      // Toggle visibility password
      const togglePassword = document.getElementById('togglePassword');
      const passwordInput = document.getElementById('passwordInput');
      const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
      const confirmPasswordInput = document.getElementById('confirmPasswordInput');
      
      togglePassword.addEventListener('click', function() {
        const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
        
        if (type === 'text') {
          this.classList.add('text-[#5a6a4e]');
        } else {
          this.classList.remove('text-[#5a6a4e]');
        }
      });

      toggleConfirmPassword.addEventListener('click', function() {
        const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
        confirmPasswordInput.setAttribute('type', type);
        this.classList.toggle('bi-eye');
        this.classList.toggle('bi-eye-slash');
        
        if (type === 'text') {
          this.classList.add('text-[#5a6a4e]');
        } else {
          this.classList.remove('text-[#5a6a4e]');
        }
      });
    }
  </script>
</body>
</html>