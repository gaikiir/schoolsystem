<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <!-- Navbar -->
  <nav>
    <div class="container">
      <div>
        <!-- Logo -->
        <div class="logo">
          <a href="/">IST</a>
        </div>
        <!-- Menu -->
        <div class="nav-menu">
          <a href="/">Home</a>
          <a href="/events">Events</a>
          <a href="/blogs">Blog</a>
          <a href="/programs">Programs</a>
          <a href="/about">About</a>
          <a href="/contact-us">Contact</a>
          <!-- Conditional Auth Links -->
          @guest
            <a href="/login" class="login bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Login</a>
            <a href="/register" class="register bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded">Register</a>
          @else
            <!-- User Dropdown -->
            <div class="relative inline-block">
              <button class="flex items-center space-x-2 focus:outline-none" id="userDropdown">
                <!-- User Icon (SVG) -->
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                </svg>
                <span>{{ Auth::user()->name }}</span>
              </button>
              <!-- Dropdown Menu -->
              <div id="dropdownMenu" class="hidden absolute right-0 mt-2 w-48 bg-slate-800 rounded-md shadow-lg py-1 z-10">
                <a href="/profile" class="block px-4 py-2 text-white hover:bg-gray-700">Profile</a>
                <a href="{{route('admindash')}}" class="block px-4 py-2 text-white hover:bg-gray-700">Dashboard</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST">
                  @csrf
                  <button type="submit" class="block w-full text-left px-4 py-2 text-white hover:bg-gray-700">Logout</button>
                </form>
              </div>
            </div>
          @endguest
        </div>
        <!-- Hamburger Menu -->
        <div class="hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
      </div>
    </div>
  </nav>

  <!-- Main Content Placeholder -->
  <main class="main">
    @yield('content')
  </main>

  <!-- Footer -->
  <footer>
    <div class="container">
      <div class="grid">
        <!-- About Section -->
        <div>
          <h3>About Us</h3>
          <p>We are a company dedicated to providing excellent services and engaging content. Learn more about our mission and values.</p>
        </div>
        <!-- Quick Links -->
        <div>
          <h3>Quick Links</h3>
          <ul>
            <li><a href="/">Home</a></li>
            <li><a href="/events">Events</a></li>
            <li><a href="/">Blog</a></li>
            <li><a href="#">Services</a></li>
            <li><a href="/about">About</a></li>
            <li><a href="#">Contact</a></li>
          </ul>
        </div>
        <!-- Contact Info -->
        <div class="p-6 rounded-lg mt-4">
          <h3 class="font-semibold text-xl text-gray-100 tracking-tight mb-3">Contact Info</h3>
          <p class="text-gray-400 font-medium text-base leading-relaxed mb-2">
            Feel free to reach out for inquiries or collaboration!
          </p>
          <ul class="text-gray-400 text-sm font-light space-y-2">
            <li><span class="font-medium">Email:</span> <a href="mailto:gaichris380@gmail.com" class="text-blue-500 hover:underline">gaichris380@gmail.com</a></li>
            <li><span class="font-medium">Phone:</span> <a href="tel:+1234567890" class="text-blue-500 hover:underline">+254 (790) 817-881</a></li>
            <li><span class="font-medium">Twitter:</span> <a href="https://x.com/example" class="text-blue-500 hover:underline">@example</a></li>
            <li><span class="font-medium">Address:</span> Lavington - Nairobi - Kenya</li>
          </ul>
        </div>
      </div>
      <div class="copyright">
        <p>© copyright 2025 gaichris.org.co.ltd . All rights reserved.</p>
      </div>
    </div>
  </footer>

  <!-- JavaScript for Hamburger Menu and Dropdown -->
  <script>
    // Hamburger Menu
    const hamburger = document.querySelector('.hamburger');
    const navMenu = document.querySelector('.nav-menu');

    hamburger.addEventListener('click', () => {
      hamburger.classList.toggle('active');
      navMenu.classList.toggle('active');
    });

    document.querySelectorAll('.nav-menu a').forEach(link => {
      link.addEventListener('click', () => {
        hamburger.classList.remove('active');
        navMenu.classList.remove('active');
      });
    });

    // Dropdown Menu
    const userDropdown = document.querySelector('#userDropdown');
    const dropdownMenu = document.querySelector('#dropdownMenu');

    if (userDropdown && dropdownMenu) {
      userDropdown.addEventListener('click', () => {
        dropdownMenu.classList.toggle('hidden');
      });

      // Close dropdown when clicking outside
      document.addEventListener('click', (event) => {
        if (!userDropdown.contains(event.target) && !dropdownMenu.contains(event.target)) {
          dropdownMenu.classList.add('hidden');
        }
      });
    }
  </script>
</body>
</html>
