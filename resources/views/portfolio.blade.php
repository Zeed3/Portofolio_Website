@extends('layouts.app')

@section('content')

  {{-- Hero --}}
  <section class="hero">
    <div class="hero-text">
      <div class="hero-badge">
        <span class="hero-badge-dot"></span>
        open to new projects
      </div>
      <h1>Hi, I'm <span>Zahwan</span>.</h1>
      <p class="hero-sub">
        A Computer Science undergraduate from Jakarta with a strong preference for back-end
        development. I build responsive applications and wire them up to services in
        PHP, SQL, and JavaScript.
      </p>
      <div class="hero-actions">
        <a class="btn-primary" href="{{ route('work') }}">view my work</a>
        <a class="btn-secondary" href="{{ route('resume') }}">↓ resume</a>
      </div>
    </div>
    <div class="avatar-area">
      <div class="avatar-ring">
        <span class="avatar-initials">ZS</span>
        <span class="avatar-badge">Undergraduate</span>
      </div>
    </div>
  </section>

  {{-- Stats --}}
  <div class="stats-row">
    @foreach ($stats as $stat)
      <div class="stat">
        <div class="stat-num">{{ $stat['num'] }}</div>
        <div class="stat-label">{{ $stat['label'] }}</div>
      </div>
    @endforeach
  </div>

  {{-- Work --}}
  <section class="section">
    <div class="section-header">
      <span class="section-title">selected works</span>
      <a href="{{ route('work') }}" class="section-link">view all →</a>
    </div>
    <div class="work-grid">
      @foreach ($projects as $project)
        <div class="work-card">
          <div class="work-thumb work-thumb--{{ $project['color'] }}">{{ $project['emoji'] }}</div>
          <h3>{{ $project['title'] }}</h3>
          <p>{{ $project['desc'] }}</p>
          <span class="work-tag work-tag--{{ $project['color'] }}">{{ $project['tag'] }}</span>
        </div>
      @endforeach
    </div>
  </section>

  <div class="divider"></div>

  {{-- About --}}
  <section class="about-section">
    <div class="about-text">
      <h2>about me</h2>
      <p>{{ $bio }}</p>
      <div class="skills-wrap">
        @foreach ($skills as $skill)
          <span class="skill-pill">{{ $skill }}</span>
        @endforeach
      </div>
    </div>

    <div class="contact-card">
      <h3>contacts</h3>
      @foreach ($contacts as $contact)
        @include('partials.contact-item')
      @endforeach
    </div>
  </section>

  {{-- Organisational Experience --}}
  <section class="section">
    <div class="section-header">
      <span class="section-title">organisational experience</span>
    </div>
    <div class="org-list">
      @foreach ($orgs as $org)
        <div class="org-item">
          <div class="org-logo org-logo--{{ $org['color'] }}">{{ $org['logo'] }}</div>
          <div class="org-body">
            <div class="org-header">
              <div>
                <div class="org-role">{{ $org['role'] }}</div>
                <div class="org-name">{{ $org['name'] }}</div>
              </div>
              <span class="org-period">{{ $org['period'] }}</span>
            </div>
            <p class="org-desc">{{ $org['desc'] }}</p>
            <div class="org-tags">
              @foreach ($org['tags'] as $tag)
                <span class="org-tag">{{ $tag }}</span>
              @endforeach
            </div>
          </div>
        </div>
      @endforeach
    </div>
  </section>

@endsection
