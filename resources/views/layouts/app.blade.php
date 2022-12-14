<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Abuelo's Delicatessen</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="assets/img/favicon.png" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:300,300i,400,400i,600,600i,700,700i|Satisfy|Comic+Neue:300,300i,400,400i,700,700i" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <!-- <link href="assets/vendor/animate.css/animate.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/boxicons/css/boxicons.min.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet"> -->

  <link href="{{ asset('/vendor/animate.css/animate.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/bootstrap-icons/bootstrap-icons.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/boxicons/css/boxicons.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/glightbox/css/glightbox.min.css') }}" rel="stylesheet">
  <link href="{{ asset('/vendor/swiper/swiper-bundle.min.css') }}" rel="stylesheet">



 <!-- Alpine v3 -->
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <!-- Focus plugin -->
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script>

   <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    @stack('mystyles')

      <!-- Template Main CSS File -->
  <link href="{{ asset('/css/style.css') }}" rel="stylesheet">
</head>

<body>

  <!-- ======= Top Bar ======= -->
  <section id="topbar" class="d-flex align-items-center fixed-top @if(Request::url() === '/') topbar-transparent @endif">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-center justify-content-lg-start">
      <i class="bi bi-phone d-flex align-items-center"><span>0915 560 0480</span></i>
      <i class="bi bi-clock ms-4 d-none d-lg-flex align-items-center"><span>Mon-Fri: 09:00 AM - 05:00 PM</span></i>
    </div>
  </section>

  <!-- ======= Header ======= -->
  <header id="header" class="fixed-top d-flex align-items-center @if(Request::url() === '/') header-transparent @endif">
    <div class="container-fluid container-xl d-flex align-items-center justify-content-between">

      <div class="logo me-auto">
        <h1><a href="/">Abuelo's Delicatessen</a></h1>
        <!-- Uncomment below if you prefer to use an image logo -->
        <!-- <a href="index.html"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->
      </div>

      <nav id="navbar" class="navbar order-last order-lg-0">
        <ul>
          @auth
          <li><a class="nav-link scrollto active" href="/">Home</a></li>
          <!-- <li><a class="nav-link scrollto" href="#about">About</a></li> -->
          <li><a class="nav-link scrollto" href="/#menu">Products</a></li>
          <!-- <li><a class="nav-link scrollto" href="#specials">Specials</a></li>
          <li><a class="nav-link scrollto" href="#events">Events</a></li>
          <li><a class="nav-link scrollto" href="#chefs">Chefs</a></li>
          <li><a class="nav-link scrollto" href="#gallery">Gallery</a></li> -->
          
          <li class="dropdown"><a href="#"><span>{{Auth::user()->name}}<i class="bi bi-person fs-6"></i></span> <i class="bi bi-chevron-down"></i></a>
            <ul>
              @if (Auth::user()->role == 'admin')
              <li><a href="{{ route('dashboard') }}">Manage Products</a></li>
              <li class="dropdown"><a href="#"><span>Customer Orders</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
              <li><a href="{{ route('manage-orders') }}">Pending Orders</a></li>
              <li><a href="{{ route('fulfilled-orders') }}">Fulfilled Orders</a></li>
              <li><a href="{{ route('canceled-orders') }}">Canceled Orders</a></li>
                  {{-- <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li> --}}
                </ul>
              </li>
              @endif

              {{-- <li><a href="{{ route('myOrders') }}">My Orders</a></li> --}}
              {{-- <li><a href="#">Edit Profile</a></li> --}}
              <li class="dropdown"><a href="#"><span>My Orders</span> <i class="bi bi-chevron-right"></i></a>
                <ul>
                  <li><a href="{{ route('myOrders') }}">Pending Orders</a></li>
                  <li><a href="{{ route('myFulfilledOrders') }}">Fulfilled Orders</a></li>
                  <li><a href="{{ route('myCanceledOrders') }}">Canceled Orders</a></li>
                  {{-- <li><a href="#">Deep Drop Down 2</a></li>
                  <li><a href="#">Deep Drop Down 3</a></li>
                  <li><a href="#">Deep Drop Down 4</a></li>
                  <li><a href="#">Deep Drop Down 5</a></li> --}}
                </ul>
              </li>
              {{-- <li><a href="#">Drop Down 2</a></li>
              <li><a href="#">Drop Down 3</a></li> --}}
              <li>
                
              <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                  {{ __('Logout') }}
              </a>

              <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                  @csrf
              </form>

              </li>
            </ul>
          </li>
          @endauth
          @guest
          <li><a class="nav-link" href="/login">Login</a></li>
          @if (Route::has('register'))
                                <li>
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
          @endguest
        </ul>
        <i class="bi bi-list mobile-nav-toggle"></i>
      </nav><!-- .navbar -->

      <a href="/cart" class="book-a-table-btn scrollto position-relative">
        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
          @php
          $items = \Cart::getContent();
          $countProducts = 0;
            foreach ($items as $item) {
              $countProducts += $item->quantity;
            }
            echo $countProducts
          @endphp
          {{-- {{ Cart::getTotalQuantity()}} --}}
          <span class="visually-hidden">unread messages</span>
        </span>
        <i class="bi bi-cart4"></i> Cart
      </a>

    </div>
  </header><!-- End Header -->


        <main class="">
            @yield('content')
        </main>


<!-- ======= Footer ======= -->
  <footer id="footer">
    <div class="container">
      <h3>Abuelo's Delicatessen</h3>
      <p>“There is no sincere love than the love of food.” <br> – George Bernard Shaw</p>
      <div class="social-links">
        {{-- <a href="#" class="twitter"><i class="bx bxl-twitter"></i></a> --}}
        <a href="#" class="facebook"><i class="bx bxl-facebook"></i></a>
        <a href="#" class="instagram"><i class="bx bxl-instagram"></i></a>
        <a href="#" class="google-plus"><i class="bx bxl-skype"></i></a>
        <a href="#" class="linkedin"><i class="bx bxl-linkedin"></i></a>
      </div>
      <div class="copyright">
        &copy; Copyright <strong><span>Abuelo's Delicatessen</span></strong>. All Rights Reserved
      </div>
      <div class="credits">
        <!-- All the links in the footer should remain intact. -->
        <!-- You can delete the links only if you purchased the pro version. -->
        <!-- Licensing information: https://bootstrapmade.com/license/ -->
        <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/delicious-free-restaurant-bootstrap-theme/ -->
        {{-- Designed by <a href="https://bootstrapmade.com/">BootstrapMade</a> --}}
      </div>
    </div>
  </footer><!-- End Footer -->

  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Vendor JS Files -->
  <script src="{{asset('/vendor/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
  <script src="{{asset('/vendor/glightbox/js/glightbox.min.js')}}"></script>
  <script src="{{asset('/vendor/isotope-layout/isotope.pkgd.min.js')}}"></script>
  <script src="{{asset('/vendor/swiper/swiper-bundle.min.js')}}"></script>
  <script src="{{asset('/vendor/php-email-form/validate.js')}}"></script>

  <!-- <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script> -->

  <!-- Template Main JS File -->
  <script src="{{asset('/js/main.js')}}"></script>
  <!-- <script src="assets/js/main.js"></script> -->

  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <script>
        const Toast = Swal.mixin({
        toast: true,
        position: 'top-end',
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
        }
        })
  </script>
    @stack('myscripts')
    @livewireScripts
</body>

</html>
