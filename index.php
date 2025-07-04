<!-- Halaman pertama kali web diakses -->
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Arena101</title>
  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- Import font awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <!-- css tambahan agar scroll smooth -->
  <style>
    html {
      scroll-behavior: smooth;
    }
  </style>
</head>
<body class="font-sans bg-[#b2c3a3]"> 

  <!-- Navbar -->
  <header class="sticky top-0 z-50 bg-[#5a6a4e] shadow-md"> <!-- Warna primary -->
    <nav class="container mx-auto px-4 py-3 flex flex-col md:flex-row justify-between items-center">
      <!-- Logo/Mobile Menu -->
      <div class="w-full md:w-auto flex justify-between items-center">
        <a href="#hero" class="text-xl font-bold text-white">Arena101</a>
        <button class="md:hidden text-white focus:outline-none">
          <i class="fas fa-bars text-2xl"></i>
        </button>
      </div>
      
      <!-- Nav Items -->
      <div class="hidden md:flex flex-1 justify-center mt-4 md:mt-0">
        <div class="flex flex-col md:flex-row space-y-2 md:space-y-0 md:space-x-4 w-full md:w-auto">
          <a href="#hero" class="text-white hover:bg-white/20 py-2 px-4 rounded-full font-medium transition text-center">Beranda</a>
          <a href="#about" class="text-white hover:bg-white/20 py-2 px-4 rounded-full font-medium transition text-center">Tentang kami</a>
          <a href="#tata-cara" class="text-white hover:bg-white/20 py-2 px-4 rounded-full font-medium transition text-center">Tata Cara</a>
          <a href="#kontak" class="text-white hover:bg-white/20 py-2 px-4 rounded-full font-medium transition text-center">Kontak</a>
        </div>
      </div>
      
      <!-- Login Button -->
      <div class="hidden md:block">
        <a href="login.php">
          <button class="py-2 px-4 bg-[#90a087] hover:bg-[#b2c3a3] text-white font-medium rounded-lg transition">Login</button>
        </a>
      </div>
    </nav>

  <!-- Hero Section -->
  <section id="hero" class="h-screen relative bg-[url('img/bgStadion.jpg')] bg-no-repeat bg-center bg-cover flex items-center">
    <div class="container mx-auto px-20 text-white text-center md:text-left">
      <h1 class="text-4xl md:text-6xl font-bold mb-5 text-white">Arena101</h1>
      <p class="text-xl md:text-2xl mb-8 [text-shadow:_1px_1px_2px_rgba(0,0,0,0.7)]">Arenamu, Atur Jadwalmu!</p>
      <a href="login.php" class="inline-block py-3 px-6 bg-[#5a6a4e] hover:bg-[#5a6a4e]/80 text-white rounded-lg font-bold transition shadow-lg">Booking Sekarang</a>
    </div>
  </section>

  <!-- Tentang Kami -->
  <section id="about" class="py-20 px-6 bg-[#b2c3a3]">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold text-center text-white">Tentang Kami</h2>
      <div class="flex flex-col md:flex-row items-center p-8">
        <img src="img/arena.jpg" alt="Lapangan Futsal" class="w-full md:w-1/3 rounded-lg shadow-lg border-4 border-[#5a6a4e] hover:animate-pulse" />
        <div class="md:w-1/2 p-20">
          <h3 class="text-2xl font-bold text-[#5a6a4e] mb-5">Kenapa <span class="text-[#5a6a4e]">Arena101 ?</span></h3>
          <p class="mb-2 text-[#5a6a4e] mb-3">
            Arena101 adalah platform pemesanan lapangan futsal dan badminton yang memudahkan kamu untuk bermain kapan saja.
            Dengan proses booking yang cepat dan mudah, kami menyediakan lapangan berkualitas untuk pengalaman bermain yang menyenangkan.
          </p>
          <p class="font-bold text-[#5a6a4e]">Cukup pilih, tentukan waktu, dan nikmati permainan!</p>
        </div>
      </div>
    </div>
  </section>

  <!-- Tata Cara Booking -->
  <section id="tata-cara" class="py-16 px-6 bg-[#5a6a4e] text-white">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold mb-8 text-center">Tata Cara Booking</h2>
      <p class="text-xl mb-12 text-center">Berikut adalah tata cara booking lapangan melalui Arena101</p>

      <div class="overflow-x-auto">
        <table class="w-full md:w-4/5 mx-auto bg-[#90a087] rounded-lg overflow-hidden">
          <tbody class="divide-y divide-white/20">
            <tr class="hover:bg-[#5a6a4e]/80 transition">
              <td class="p-4 font-medium w-1/5">Login/Daftar</td>
              <td class="p-4">Masuk ke akunmu atau daftar terlebih dahulu jika belum punya akun.</td>
            </tr>
            <tr class="hover:bg-[#5a6a4e]/80 transition">
              <td class="p-4 font-medium">Pilih Lapangan</td>
              <td class="p-4">Telusuri dan pilih lapangan futsal atau badminton yang kamu inginkan.</td>
            </tr>
            <tr class="hover:bg-[#5a6a4e]/80 transition">
              <td class="p-4 font-medium">Tentukan Waktu</td>
              <td class="p-4">Pilih tanggal dan jam sesuai keinginanmu.</td>
            </tr>
            <tr class="hover:bg-[#5a6a4e]/80 transition">
              <td class="p-4 font-medium">Konfirmasi & Bayar</td>
              <td class="p-4">Lakukan konfirmasi dan selesaikan pembayaran.</td>
            </tr>
            <tr class="hover:bg-[#5a6a4e]/80 transition">
              <td class="p-4 font-medium">Bermain!</td>
              <td class="p-4">Tunjukkan bukti booking dan nikmati permainanmu di Arena101.</td>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
  </section>

  <!-- Kontak Section -->
  <section id="kontak" class="py-16 px-6 bg-[#b2c3a3] text-white">
    <div class="container mx-auto">
      <h2 class="text-3xl font-bold mb-12 text-center">Hubungi Kami</h2>
      
      <div class="grid grid-cols-1 md:grid-cols-2 gap-6 max-w-4xl mx-auto">
        <!-- WhatsApp -->
        <a href="https://wa.me/6288218985467" target="_blank" 
           class="flex items-center bg-green-500 hover:bg-green-600 text-white p-6 rounded-lg transition shadow-md">
          <div class="bg-white/20 p-4 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-whatsapp" viewBox="0 0 16 16">
              <path d="M13.601 2.326A7.85 7.85 0 0 0 7.994 0C3.627 0 .068 3.558.064 7.926c0 1.399.366 2.76 1.057 3.965L0 16l4.204-1.102a7.9 7.9 0 0 0 3.79.965h.004c4.368 0 7.926-3.558 7.93-7.93A7.9 7.9 0 0 0 13.6 2.326zM7.994 14.521a6.6 6.6 0 0 1-3.356-.92l-.24-.144-2.494.654.666-2.433-.156-.251a6.56 6.56 0 0 1-1.007-3.505c0-3.626 2.957-6.584 6.591-6.584a6.56 6.56 0 0 1 4.66 1.931 6.56 6.56 0 0 1 1.928 4.66c-.004 3.639-2.961 6.592-6.592 6.592m3.615-4.934c-.197-.099-1.17-.578-1.353-.646-.182-.065-.315-.099-.445.099-.133.197-.513.646-.627.775-.114.133-.232.148-.43.05-.197-.1-.836-.308-1.592-.985-.59-.525-.985-1.175-1.103-1.372-.114-.198-.011-.304.088-.403.087-.088.197-.232.296-.346.1-.114.133-.198.198-.33.065-.134.034-.248-.015-.347-.05-.099-.445-1.076-.612-1.47-.16-.389-.323-.335-.445-.34-.114-.007-.247-.007-.38-.007a.73.73 0 0 0-.529.247c-.182.198-.691.677-.691 1.654s.71 1.916.81 2.049c.098.133 1.394 2.132 3.383 2.992.47.205.84.326 1.129.418.475.152.904.129 1.246.08.38-.058 1.171-.48 1.338-.943.164-.464.164-.86.114-.943-.049-.084-.182-.133-.38-.232"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-lg">WhatsApp</h3>
            <p>+62 882 1898 5467</p>
          </div>
        </a>
        
        <!-- Email -->
        <a href="mailto:delianurilmi@gmail.com" 
           class="flex items-center bg-blue-400 hover:bg-blue-600 text-white p-6 rounded-lg transition shadow-md">
          <div class="bg-white/20 p-4 rounded-full mr-4">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-at-fill" viewBox="0 0 16 16">
              <path d="M2 2A2 2 0 0 0 .05 3.555L8 8.414l7.95-4.859A2 2 0 0 0 14 2zm-2 9.8V4.698l5.803 3.546zm6.761-2.97-6.57 4.026A2 2 0 0 0 2 14h6.256A4.5 4.5 0 0 1 8 12.5a4.49 4.49 0 0 1 1.606-3.446l-.367-.225L8 9.586zM16 9.671V4.697l-5.803 3.546.338.208A4.5 4.5 0 0 1 12.5 8c1.414 0 2.675.652 3.5 1.671"/>
              <path d="M15.834 12.244c0 1.168-.577 2.025-1.587 2.025-.503 0-1.002-.228-1.12-.648h-.043c-.118.416-.543.643-1.015.643-.77 0-1.259-.542-1.259-1.434v-.529c0-.844.481-1.4 1.26-1.4.585 0 .87.333.953.63h.03v-.568h.905v2.19c0 .272.18.42.411.42.315 0 .639-.415.639-1.39v-.118c0-1.277-.95-2.326-2.484-2.326h-.04c-1.582 0-2.64 1.067-2.64 2.724v.157c0 1.867 1.237 2.654 2.57 2.654h.045c.507 0 .935-.07 1.18-.18v.731c-.219.1-.643.175-1.237.175h-.044C10.438 16 9 14.82 9 12.646v-.214C9 10.36 10.421 9 12.485 9h.035c2.12 0 3.314 1.43 3.314 3.034zm-4.04.21v.227c0 .586.227.8.581.8.31 0 .564-.17.564-.743v-.367c0-.516-.275-.708-.572-.708-.346 0-.573.245-.573.791"/>
            </svg>
          </div>
          <div>
            <h3 class="font-bold text-lg">Email</h3>
            <p>info@arena101.com</p>
          </div>
          <i class="fas fa-chevron-right ml-auto"></i>
        </a>
      </div>
      
      <div class="mt-16 text-center text-[#5a6a4e] ">
        <p>© 2025 Arena101. All rights reserved.</p>
      </div>
    </div>
  </section>

  <script>
    // Mobile menu toggle
    document.querySelector('header button').addEventListener('click', function() {
      const menu = document.querySelector('header .hidden');
      menu.classList.toggle('hidden');
      menu.classList.toggle('flex');
    });
  </script>

</body>
</html>