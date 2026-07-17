{{-- Interactive "run it yourself" panel. Client-side only, so it stays static-safe. --}}
<div class="run-panel">
  <div class="run-tabs" role="tablist">
    <button type="button" class="run-tab active" data-tab="docker" role="tab" aria-selected="true">Docker</button>
    <button type="button" class="run-tab" data-tab="local" role="tab" aria-selected="false">Local PHP</button>
  </div>

  <div class="run-pane active" data-pane="docker" role="tabpanel">
    <div class="code-block">
      <button type="button" class="copy-btn" aria-label="Copy to clipboard">Copy</button>
      <pre><code>docker compose up --build</code></pre>
    </div>
    <p class="run-note">Run from the project root, then open <a href="http://localhost:8000">localhost:8000</a>. No PHP install needed.</p>
  </div>

  <div class="run-pane" data-pane="local" role="tabpanel" hidden>
    <div class="code-block">
      <button type="button" class="copy-btn" aria-label="Copy to clipboard">Copy</button>
      <pre><code>composer install
cp .env.example .env
php artisan key:generate
php artisan serve</code></pre>
    </div>
    <p class="run-note">Requires PHP 8.2+ and Composer, then open <a href="http://localhost:8000">localhost:8000</a>.</p>
  </div>
</div>
