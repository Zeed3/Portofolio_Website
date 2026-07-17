@extends('layouts.app')

@section('title', 'Work · Zahwan Satria')

@section('content')

  <section class="section">
    <div class="page-header">
      <a href="{{ route('home') }}" class="back-link">← back</a>
      <h1 class="page-title">selected works</h1>
      <p class="page-sub">A collection of projects I've designed and built, from low-level C to full-stack web apps.</p>
    </div>

    <div class="project-list">
      @foreach ($projects as $project)
        <article class="project">
          <div class="project-head">
            <div class="work-thumb" style="background: {{ $project['thumb'] }};">{{ $project['emoji'] }}</div>
            <div class="project-heading">
              <h2 class="project-title">{{ $project['title'] }}</h2>
              @if (!empty($project['context']))
                <span class="project-context">{{ $project['context'] }}</span>
              @endif
            </div>
            <span class="work-tag {{ $project['tagClass'] }}">{{ $project['tag'] }}</span>
          </div>

          <p class="project-desc">{{ $project['longDesc'] ?? $project['desc'] }}</p>

          @if (!empty($project['highlights']))
            <ul class="project-highlights">
              @foreach ($project['highlights'] as $highlight)
                <li>{{ $highlight }}</li>
              @endforeach
            </ul>
          @endif

          @if (!empty($project['stack']))
            <div class="project-stack">
              @foreach ($project['stack'] as $tech)
                <span class="stack-pill">{{ $tech }}</span>
              @endforeach
            </div>
          @endif

          @if (!empty($project['runnable']))
            @include('partials.run-instructions')
          @endif
        </article>
      @endforeach
    </div>
  </section>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      // Copy-to-clipboard buttons (with fallback for insecure/older contexts)
      function fallbackCopy(text) {
        var ta = document.createElement('textarea');
        ta.value = text;
        ta.setAttribute('readonly', '');
        ta.style.position = 'fixed';
        ta.style.opacity = '0';
        document.body.appendChild(ta);
        ta.select();
        var ok = false;
        try { ok = document.execCommand('copy'); } catch (e) { ok = false; }
        document.body.removeChild(ta);
        return ok;
      }

      function flashCopied(btn) {
        var original = btn.getAttribute('data-label') || btn.textContent;
        btn.setAttribute('data-label', original);
        btn.textContent = 'Copied!';
        btn.classList.add('copied');
        setTimeout(function () {
          btn.textContent = original;
          btn.classList.remove('copied');
        }, 1500);
      }

      document.querySelectorAll('.copy-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
          var code = btn.parentElement.querySelector('code').innerText;
          if (navigator.clipboard && navigator.clipboard.writeText) {
            navigator.clipboard.writeText(code)
              .then(function () { flashCopied(btn); })
              .catch(function () { if (fallbackCopy(code)) { flashCopied(btn); } });
          } else if (fallbackCopy(code)) {
            flashCopied(btn);
          }
        });
      });

      // Tab switching
      document.querySelectorAll('.run-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
          var panel = tab.closest('.run-panel');
          panel.querySelectorAll('.run-tab').forEach(function (t) {
            t.classList.remove('active');
            t.setAttribute('aria-selected', 'false');
          });
          panel.querySelectorAll('.run-pane').forEach(function (p) {
            p.hidden = true;
            p.classList.remove('active');
          });
          tab.classList.add('active');
          tab.setAttribute('aria-selected', 'true');
          var pane = panel.querySelector('.run-pane[data-pane="' + tab.dataset.tab + '"]');
          pane.hidden = false;
          pane.classList.add('active');
        });
      });
    });
  </script>

@endsection
