<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>@yield('title', 'Zahwan Satria · Portfolio')</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}" />
  {{-- Applies a saved theme choice before the page paints, so there is no
       flash of the wrong theme on load. Without a saved choice, the CSS
       falls back to the operating system's setting. --}}
  <script>
    (function () {
      try {
        var saved = localStorage.getItem('theme');
        if (saved === 'light' || saved === 'dark') {
          document.documentElement.setAttribute('data-theme', saved);
        }
      } catch (e) {}
    })();
  </script>
</head>
<body>

  <div class="site-wrapper">

    {{-- Navigation --}}
    <nav class="nav">
      <a class="nav-logo" href="{{ route('home') }}">Zahwan</a>
      <ul class="nav-links">
        <li><a href="{{ route('work') }}" @class(['active' => request()->routeIs('work')])>work</a></li>
        <li><a href="{{ route('about') }}" @class(['active' => request()->routeIs('about')])>about</a></li>
        <li><a href="{{ route('resume') }}" @class(['active' => request()->routeIs('resume')])>resume</a></li>
        <li>
          <button type="button" class="theme-toggle" id="theme-toggle" title="Switch between light and dark mode" aria-label="Switch between light and dark mode">
            <svg class="icon-moon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M21 12.79A9 9 0 1 1 11.21 3a7 7 0 0 0 9.79 9.79z"/></svg>
            <svg class="icon-sun" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><circle cx="12" cy="12" r="4"/><path d="M12 2v2m0 16v2M4.93 4.93l1.41 1.41m11.32 11.32 1.41 1.41M2 12h2m16 0h2M4.93 19.07l1.41-1.41M17.66 6.34l1.41-1.41"/></svg>
          </button>
        </li>
      </ul>
    </nav>

    @yield('content')

    {{-- Footer --}}
    <footer class="footer">
      <span class="footer-text">Zahwan</span>
      <div class="footer-icons">
        <a href="https://github.com/Zeed3" aria-label="GitHub" target="_blank" rel="noopener">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><path d="M9 19c-5 1.5-5-2.5-7-3m14 6v-3.87a3.37 3.37 0 0 0-.94-2.61c3.14-.35 6.44-1.54 6.44-7A5.44 5.44 0 0 0 20 4.77 5.07 5.07 0 0 0 19.91 1S18.73.65 16 2.48a13.38 13.38 0 0 0-7 0C6.27.65 5.09 1 5.09 1A5.07 5.07 0 0 0 5 4.77a5.44 5.44 0 0 0-1.5 3.78c0 5.42 3.3 6.61 6.44 7A3.37 3.37 0 0 0 9 18.13V22"/></svg>
        </a>
        <a href="https://www.linkedin.com/in/zahwansatria" aria-label="LinkedIn" target="_blank" rel="noopener">
          <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5" aria-hidden="true"><rect x="2" y="2" width="20" height="20" rx="4"/><path d="M16 8h-2a4 4 0 0 0-4 4v2H8m4-6v10"/></svg>
        </a>
      </div>
    </footer>

  </div>

  <script>
    document.getElementById('theme-toggle').addEventListener('click', function () {
      var root = document.documentElement;
      // Whatever is showing right now: an explicit choice, else the OS setting.
      var current = root.getAttribute('data-theme');
      var effective = current || (window.matchMedia('(prefers-color-scheme: dark)').matches ? 'dark' : 'light');
      var next = effective === 'dark' ? 'light' : 'dark';
      root.setAttribute('data-theme', next);
      try { localStorage.setItem('theme', next); } catch (e) {}
    });
  </script>

</body>
</html>
