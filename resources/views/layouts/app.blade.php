<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>title</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css"
    integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.1/css/all.min.css"
    integrity="sha512-5Hs3dF2AEPkpNAR7UiOHba+lRSJNeM2ECkwxUIxC1Q/FLycGTbNapWXB4tP889k5T5Ju8fs4b1P5z/iB4nMfSQ=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="{{asset('assets/css/custom.css')}}">
  <style>
    .navbar-nav .nav-link.active {
      color: blue !important
    }
  </style>
</head>

<body>

  <nav class="navbar navbar-expand-lg navbar-light {{ Request::is('recipes/cooking*') ? 'd-none' : ''}} ">
    <div class="container">
      <a class="navbar-brand {{Request::is('/') ? 'acitve' : ''}}" href="/">
        <img src="{{asset('assets/img/logo/Dark Green 1.png')}}" alt="">
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('/') ? 'acitve' : ''}}" href="/">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('about') ? 'acitve' : ''}}"
              href="{{ route('about-us') }}">About</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('prices') ? 'acitve' : ''}}"
              href="{{route('prices.index')}}">Pricing</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('meal-plan') ? 'acitve' : ''}}"
              href="{{ route('meal-plan') }}">Meal Plan</a>
          </li>

          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('plans') ? 'acitve' : ''}}"
              href="{{ route('plans.index') }}">Plan</a>
          </li>
        </ul>
        <ul class="navbar-nav ml-auto">
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('recipes') ? 'acitve' : ''}}"
              href="{{ route('web.recipes') }}">Recipes</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('favourites') ? 'acitve' : ''}}"
              href="{{ route('favourite.index') }}">Favourite</a>
          </li>
          @auth

          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('shoppings') ? 'acitve' : ''}}"
              href="{{ route('shopping.index') }}">Shopping</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('accounts') ? 'acitve' : ''}}"
              href="{{ route('accounts.index') }}">Account</a>
          </li>
          <li class="nav-item">
          <li class="nav-item">
            <form method="POST" action="{{ route('logout') }}">
              @csrf
              <button type="submit" class="btn nav-link nav-3d-effect">Logout</button>
            </form>
          </li>

          </li>
          @endauth
          @guest
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('accounts') ? 'acitve' : ''}}"
              href="{{ route('login') }}">Login</a>
          </li>
          <li class="nav-item">
            <a class="nav-link nav-3d-effect {{Request::is('accounts') ? 'acitve' : ''}}"
              href="{{ route('register') }}">Register</a>
          </li>
          @endguest
        </ul>
      </div>
    </div>
  </nav>

  @yield('content')
  <footer class="footer-section">
    <div class="container">
      <div class="row">
        <!-- Company Info -->
        <div class="col-lg-3 col-md-6 footer-about">
          <h3 class="footer-title">About Us</h3>
          <p>
            We are passionate about delivering the best culinary experiences to our customers. Join us and savor the
            flavor of excellence.
          </p>
          <p>&copy; 2024 Your Company. All rights reserved.</p>
        </div>
        <!-- Quick Links -->
        <div class="col-lg-2 col-md-6 footer-links">
          <h3 class="footer-title">Quick Links</h3>
          <ul>
            <li><a href="#">Privacy Policy</a></li>
            <li><a href="#">Terms & Conditions</a></li>
            <li><a href="#">Cookies</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <!-- Newsletter -->
        <div class="col-lg-4 col-md-6 footer-newsletter">
          <h3 class="footer-title">Newsletter</h3>
          <p>Subscribe to our newsletter for the latest updates and offers.</p>
          <form action="#" method="post" class="newsletter-form">
            <input type="email" placeholder="Enter your email" required>
            <button type="submit">Subscribe</button>
          </form>
        </div>
        <!-- Social Media -->
        <div class="col-lg-3 col-md-6 footer-social">
          <h3 class="footer-title">Follow Us</h3>
          <div class="social-icons">
            <a href="#"><i class="fab fa-facebook-f"></i></a>
            <a href="#"><i class="fab fa-twitter"></i></a>
            <a href="#"><i class="fab fa-instagram"></i></a>
            <a href="#"><i class="fab fa-linkedin-in"></i></a>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <script src="{{asset('assets/js/custom.js')}}"></script>

  <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"
    integrity="sha384-+sLIOodYLS7CIrQpBjl+C7nPvqq+FbNUBDunl/OZv93DB7Ln/533i8e/mZXLi/P+"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
  <script></script>

  <!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="{{ asset('assets/js/custom.js') }}" defer></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script> -->
</body>

</html>