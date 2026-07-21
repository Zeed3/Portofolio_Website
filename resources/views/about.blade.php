@extends('layouts.app')

@section('title', 'About · Zahwan Satria')

@section('content')

  <section class="section">
    <div class="page-header">
      <a href="{{ route('home') }}" class="back-link">← back</a>
      <h1 class="page-title">about me</h1>
    </div>
  </section>

  <section class="about-section">
    <div class="about-text">
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
        <div class="contact-item">
          @include('partials.icon', ['name' => $contact['icon']])
          {{ $contact['text'] }}
        </div>
      @endforeach
    </div>
  </section>

  <div class="divider"></div>

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
