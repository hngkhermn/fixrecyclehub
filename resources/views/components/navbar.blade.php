<nav class="navbar navbar-expand-lg">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">
      <img src="{{ asset('images/logo.png') }}" alt="Recycle Hub" style="height: 60px;">
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav mx-auto">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="/">HOME</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="/about">ABOUT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('product') ? 'active' : '' }}" href="/product">PRODUCT</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="/contact">CONTACT</a>
        </li>
      </ul>
      <div class="d-flex align-items-center">
        <!-- Navbar Keranjang -->
        <a href="{{ route('cart') }}" class="btn btn-success me-2">
          <i class="bi bi-cart"></i> ({{ session('cart') ? count(session('cart')) : 0 }})
        </a>
        @auth
          <!-- Logout Button -->
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
            @csrf
            <button type="submit" class="btn btn-danger me-2">
              <i class="bi bi-box-arrow-right"></i> Logout
            </button>
          </form>
        @else
          <!-- Login Button -->
          <a href="{{ route('login') }}" class="btn btn-success me-2">
            <i class="bi bi-person"></i> Admin
          </a>
        @endauth
      </div>
    </div>
  </div>
</nav>
