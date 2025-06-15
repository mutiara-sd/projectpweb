<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>MakanYuk!</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
  <style>
    html, body { 
      overflow-x: hidden; 
      scroll-behavior: smooth;
    }
    
    main { 
      margin-top: 4rem; 
    }
    
    /* Hover effects */
    .hover-scale { 
      transition: transform 0.3s ease; 
    }
    .hover-scale:hover { 
      transform: scale(1.05); 
    }
    
    .hover-glow { 
      transition: box-shadow 0.3s ease; 
    }
    .hover-glow:hover { 
      box-shadow: 0 0 20px rgba(59, 130, 246, 0.5); 
    }
    
    .hover-lift { 
      transition: transform 0.3s ease, box-shadow 0.3s ease; 
    }
    .hover-lift:hover { 
      transform: translateY(-5px); 
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
    }
    
    /* Gradient backgrounds */
    .gradient-blue { 
      background: linear-gradient(135deg, #3b82f6, #1d4ed8); 
    }
    .gradient-orange { 
      background: linear-gradient(135deg, #f97316, #ea580c); 
    }
    .gradient-yellow { 
      background: linear-gradient(135deg, #fbbf24, #f59e0b); 
    }
    
    /* Navy color for MakanYuk text */
    .text-navy {
      color: #1e3a8a;
    }
    
    /* Nav link hover effect */
    .nav-link {
      position: relative;
      transition: color 0.3s ease;
    }
    .nav-link::after {
      content: '';
      position: absolute;
      bottom: -5px;
      left: 0;
      width: 0;
      height: 2px;
      background: #3b82f6;
      transition: width 0.3s ease;
    }
    .nav-link:hover::after {
      width: 100%;
    }
    .nav-link:hover {
      color: #3b82f6;
    }
    
    /* Button styles */
    .btn-primary {
      position: relative;
      overflow: hidden;
      transition: all 0.3s ease;
    }
    
    /* Card interactive styles */
    .card-interactive {
      transition: all 0.3s ease;
      cursor: pointer;
    }
    .card-interactive:hover {
      transform: translateY(-8px);
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
    }
    
    /* Custom Swiper styles */
    .swiper-button-next,
    .swiper-button-prev {
      width: 50px !important;
      height: 50px !important;
      background: white !important;
      border-radius: 50% !important;
      box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
      color: #3b82f6 !important;
    }
    
    .swiper-button-next:hover,
    .swiper-button-prev:hover {
      background: #f8fafc !important;
      transform: scale(1.1);
      transition: all 0.3s ease;
    }
    
    .swiper-pagination-bullet {
      background: #3b82f6 !important;
      opacity: 0.5 !important;
    }
    
    .swiper-pagination-bullet-active {
      opacity: 1 !important;
      transform: scale(1.2);
    }
    
    /* Review card improvements */
    .review-card {
      background: white;
      border-radius: 20px;
      padding: 2rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      height: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    
    .review-card:hover {
      transform: translateY(-10px);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
    }
    
    .review-image {
      width: 80px;
      height: 80px;
      object-fit: cover;
      border-radius: 50%;
      margin: 0 auto 1.5rem;
      border: 4px solid #f1f5f9;
    }
    
    .review-text {
      font-style: italic;
      color: #475569;
      font-size: 1.1rem;
      line-height: 1.6;
      margin-bottom: 1.5rem;
      flex-grow: 1;
    }
    
    .review-stars {
      color: #fbbf24;
      font-size: 1.5rem;
      letter-spacing: 2px;
    }
  </style>
</head>

<body>
  <header class="bg-white fixed w-full top-0 left-0 z-50 shadow-lg backdrop-blur-sm bg-white/95">
    <nav class="container mx-auto flex items-center justify-between h-16 px-4">
      <div class="flex items-center gap-2">
        <img src="{{ asset('images/logo.png') }}" alt="Logo" class="h-10 hover-scale">
        <span class="font-Poppins text-xl sm:text-2xl font-semibold text-navy">MakanYuk!</span>
      </div>

      <div class="hidden lg:flex items-center gap-6 text-sm sm:text-base font-medium text-gray-700">
        <a href="#beranda" class="nav-link">Beranda</a>
        <a href="#cara_donasi" class="nav-link">Cara Donasi</a>
        <a href="#tentang_kami" class="nav-link">Tentang Kami</a>
        <a href="#review" class="nav-link">Review</a>
        <a href="#kontak" class="nav-link">Kontak</a>
        <a href="{{ route('register') }}" class="btn-primary gradient-blue hover:bg-blue-700 text-white px-5 py-2 rounded-full shadow-md hover-glow">Daftar</a>
        <a href="{{ route('login') }}" class="btn-primary gradient-blue hover:bg-blue-700 text-white px-5 py-2 rounded-full shadow-md hover-glow">Masuk</a>
      </div>

      <div class="lg:hidden text-xl sm:text-3xl cursor-pointer z-50 hover-scale" id="hamburger">
        <i class="ri-menu-4-line"></i>
      </div>
    </nav>
  </header>

  <main>
    <section id="beranda" class="relative w-full min-h-screen">
      <img src="{{ asset('images/background.png') }}" alt="Header" class="absolute top-0 left-0 w-full h-full object-cover">
      <div class="absolute inset-0 bg-gradient-to-r from-black/70 to-black/40 flex items-center">
        <div class="px-6 container mx-auto md:flex md:justify-between items-center text-white">
          <div class="md:w-3/6 text-center md:text-left md:pl-10">
            <h4 class="text-xl font-bold mb-2">MakanYuk</h4>
            <h3 class="text-3xl md:text-5xl font-bold mb-5 bg-gradient-to-r from-white to-blue-200 bg-clip-text text-transparent">
              Berbagi Makanan, Peduli Sesama
            </h3>
            <p class="text-gray-200 mb-5 text-lg leading-relaxed">
              Sekecil apa pun makananmu, bisa jadi berkah untuk yang lain. Lewat Makanyuk!, mari berbagi dengan cepat dan mudah.
              Bersama kita bisa lawan kelaparan dan kurangi pemborosan. Karena peduli itu sederhana, tapi dampaknya luar biasa.
            </p>
            <div class="flex gap-4 justify-center md:justify-start">
              <a href="{{ route('form.donasi') }}" class="btn-primary gradient-blue hover:bg-blue-700 text-white px-8 py-4 rounded-full shadow-lg text-lg font-semibold hover-lift">
                Donasi Sekarang
              </a>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section id="cara_donasi" class="text-center py-16 gradient-yellow px-6">
      <h2 class="text-2xl md:text-4xl font-bold text-blue-900 mb-12">Donasikan makananmu hari ini juga!</h2>

      <div class="flex justify-center items-center flex-wrap px-4 relative max-w-6xl mx-auto">
        
        <!-- Step 1 -->
        <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
          <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-white flex items-center justify-center shadow-xl hover-lift card-interactive">
            <img src="{{ asset('images/bukaweb.png') }}" alt="Buka Website" class="w-16 h-16 md:w-24 md:h-24 hover-scale" />
          </div>
          <p class="font-bold mt-6 text-lg text-blue-900">Buka Website</p>
        </div>

        <!-- Garis antara step 1 & 2 -->
        <div class="w-12 h-2 gradient-orange md:w-24 mt-[-40px] rounded-full"></div>

        <!-- Step 2 -->
        <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
          <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-white flex items-center justify-center shadow-xl hover-lift card-interactive">
            <img src="{{ asset('images/daftarsekarang.png') }}" alt="Login" class="w-16 h-16 md:w-24 md:h-24 hover-scale" />
          </div>
          <p class="font-bold mt-6 text-lg text-blue-900">Login</p>
        </div>

        <!-- Garis antara step 2 & 3 -->
        <div class="w-12 h-2 gradient-orange md:w-24 mt-[-40px] rounded-full"></div>

        <!-- Step 3 -->
        <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
          <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-white flex items-center justify-center shadow-xl hover-lift card-interactive">
            <img src="{{ asset('images/form.png') }}" alt="Isi Form" class="w-16 h-16 md:w-24 md:h-24 hover-scale" />
          </div>
          <p class="font-bold mt-6 text-lg text-blue-900">Isi Form</p>
        </div>

        <!-- Garis antara step 3 & 4 -->
        <div class="w-12 h-2 gradient-orange md:w-24 mt-[-40px] rounded-full"></div>

        <!-- Step 4 -->
        <div class="relative z-10 flex flex-col items-center mx-3 md:mx-6">
          <div class="w-32 h-32 md:w-40 md:h-40 rounded-full bg-white flex items-center justify-center shadow-xl hover-lift card-interactive">
            <img src="{{ asset('images/selesai.png') }}" alt="Selesai" class="w-16 h-16 md:w-24 md:h-24 hover-scale" />
          </div>
          <p class="font-bold mt-6 text-lg text-blue-900">Selesai</p>
        </div>
      </div>
    </section>

    <section id="tentang_kami" class="gradient-orange text-white py-20 px-4 md:px-20">
      <div class="flex flex-col md:flex-row items-center justify-between max-w-6xl mx-auto">
        <!-- Teks -->
        <div class="md:w-2/3 mb-8 md:mb-0">
          <h2 class="text-4xl md:text-5xl font-bold mb-8 bg-gradient-to-r from-white to-yellow-200 bg-clip-text text-transparent">
            Tentang MakanYuk!
          </h2>
          <div class="space-y-6">
            <p class="text-white text-xl leading-relaxed hover-lift p-4 bg-white/10 rounded-lg backdrop-blur-sm">
              MakanYuk! merupakan platform berbagi makanan dengan tujuan untuk mengurangi pemborosan pangan dan membantu mereka yang membutuhkan. 
              Melalui website ini, anda dapat dengan mudah membagikan makanan berlebih kepada penerima terdekat secara gratis.
            </p>
            <p class="text-white text-xl leading-relaxed hover-lift p-4 bg-white/10 rounded-lg backdrop-blur-sm">
              Dengan menghubungkan pemberi dan penerima dalam satu ekosistem digital, MakanYuk! tidak hanya mengurangi limbah makanan, 
              tetapi juga membangun solidaritas sosial dan kepedulian terhadap sesama. Kami percaya bahwa setiap makanan berharga, dan dengan berbagi, 
              kita dapat menciptakan perubahan positif di masyarakat.
            </p>
          </div>
        </div>

        <!-- Gambar/logo -->
        <div class="md:w-1/3 flex justify-center">
          <img src="{{ asset('images/logobiru.png') }}" alt="Tentang MakanYuk!" class="w-48 md:w-80 hover-scale" />
        </div>
      </div>
    </section>

    <section id="review" class="py-16 gradient-yellow text-center px-6">
      <div class="flex flex-col items-center gap-3 text-center mb-12 md:mb-20">
        <h2 class="text-3xl md:text-4xl font-bold text-blue-900">Ulasan Pengguna</h2>
        <p class="max-w-2xl text-gray-700 text-lg">Apa kata mereka tentang MakanYuk?</p>
      </div>

      <div class="relative w-full max-w-6xl mx-auto">
        <div class="swiper reviewSwiper">
          <div class="swiper-wrapper">
            <!-- Slide 1 -->
            <div class="swiper-slide">
              <div class="review-card">
                <img src="{{ asset('images/rev1.jpg') }}" alt="review_1" class="review-image" />
                <p class="review-text">"Bermanfaat, cepat, dan niat baiknya kerasa banget."</p>
              </div>
            </div>

            <!-- Slide 2 -->
            <div class="swiper-slide">
              <div class="review-card">
                <img src="{{ asset('images/rev2.jpg') }}" alt="review_2" class="review-image" />
                <p class="review-text">"Saya ikut bantu distribusi makanan dari Makanyuk! dan saya lihat sendiri wajah bahagia orang-orang yang menerima."</p>
              </div>
            </div>

            <!-- Slide 3 -->
            <div class="swiper-slide">
              <div class="review-card">
                <img src="{{ asset('images/rev3.jpg') }}" alt="review_3" class="review-image" />
                <p class="review-text">"Platform seperti ini seharusnya jadi standar di setiap kota besar. Good job, Makanyuk!"</p>
              </div>
            </div>

            <!-- Slide 4 -->
            <div class="swiper-slide">
              <div class="review-card">
                <img src="{{ asset('images/rev4.jpg') }}" alt="review_4" class="review-image" />
                <p class="review-text">"Jadi superhero makanan tanpa pakai jubah. Cukup klik-klik di Makanyuk!"</p>
              </div>
            </div>
          </div>

          <!-- Navigation buttons -->
          <div class="swiper-button-next"></div>
          <div class="swiper-button-prev"></div>
          
          <!-- Pagination -->
          <div class="swiper-pagination mt-8"></div>
        </div>
      </div>
    </section>
  </main>

  <footer id="kontak" class="gradient-orange text-white py-16 px-6">
    <div class="max-w-6xl mx-auto flex flex-col md:flex-row justify-between items-center md:items-start gap-10">
      
      <!-- Kiri: Logo & Info Kontak -->
      <div class="flex flex-col md:flex-row items-center md:items-start gap-6 md:gap-10">
        <!-- Logo -->
        <div>
          <img src="{{ asset('images/logobiru.png') }}" alt="Logo MakanYuk!" class="w-32 md:w-40 hover-scale">
        </div>

        <!-- Info Kontak -->
        <div>
          <h2 class="text-2xl font-bold mb-6 text-center md:text-left">Hubungi Kami</h2>
          <div class="space-y-4">
            <div class="flex items-center gap-3 hover-lift p-3 bg-white/10 rounded-lg backdrop-blur-sm">
              <span class="text-3xl">📞</span>
              <span class="text-lg">+62 812-xxxx-xxxx</span>
            </div>
            <div class="flex items-center gap-3 hover-lift p-3 bg-white/10 rounded-lg backdrop-blur-sm">
              <span class="text-3xl">📧</span>
              <span class="text-lg">makanyuk!@gmail.com</span>
            </div>
          </div>
        </div>
      </div>

      <!-- Kanan: Sosial Media -->
      <div class="flex flex-col items-center md:items-end">
        <h2 class="text-2xl font-bold mb-6">🌐 Social Media</h2>
        <div class="flex gap-6 text-4xl">
          <a href="#" aria-label="Instagram" class="hover-scale hover-glow p-3 bg-white/10 rounded-full backdrop-blur-sm">📸</a>
          <a href="#" aria-label="X (Twitter)" class="hover-scale hover-glow p-3 bg-white/10 rounded-full backdrop-blur-sm">𝕏</a>
          <a href="#" aria-label="Facebook" class="hover-scale hover-glow p-3 bg-white/10 rounded-full backdrop-blur-sm">📘</a>
        </div>
      </div>
    </div>

    <!-- Bawah: Legal -->
    <div class="border-t border-white/30 mt-12 pt-6 flex flex-col md:flex-row justify-between items-center text-sm text-white/90">
      <div class="flex gap-6 mb-4 md:mb-0">
        <a href="#" class="hover:text-yellow-200 hover-scale transition-colors">Kebijakan Privasi</a>
        <a href="#" class="hover:text-yellow-200 hover-scale transition-colors">Syarat Ketentuan</a>
      </div>
      <p class="text-center">&copy; {{ now()->year }} MakanYuk! - Semua Hak Dilindungi.</p>
    </div>
  </footer>

  <!-- Scripts -->
  <script>
    // Swiper initialization
    const swiper = new Swiper('.reviewSwiper', {
      slidesPerView: 1,
      spaceBetween: 30,
      loop: true,
      autoplay: {
        delay: 4000,
        disableOnInteraction: false,
      },
      pagination: {
        el: '.swiper-pagination',
        clickable: true,
        dynamicBullets: true,
      },
      navigation: {
        nextEl: '.swiper-button-next',
        prevEl: '.swiper-button-prev'
      },
      breakpoints: {
        768: {
          slidesPerView: 2,
          spaceBetween: 20
        },
        1024: {
          slidesPerView: 3,
          spaceBetween: 30
        }
      }
    });

    // Smooth scrolling for navigation links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
      anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
          target.scrollIntoView({
            behavior: 'smooth',
            block: 'start'
          });
        }
      });
    });
  </script>
</body>
</html>