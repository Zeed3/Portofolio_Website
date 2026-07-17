@extends('layouts.app')

@section('title', 'Résumé · Zahwan Satria')

@section('content')

  <section class="section">
    <div class="page-header">
      <a href="{{ route('home') }}" class="back-link">← back</a>
      <div class="resume-headline">
        <h1 class="page-title">Zahwan Satria</h1>
        <button class="btn-secondary resume-print" onclick="window.print()">↓ save as PDF</button>
      </div>
      <p class="page-sub">{{ $summary }}</p>
    </div>

    {{-- Experience --}}
    <div class="resume-block">
      <h2 class="resume-heading">Experience</h2>
      @foreach ($experience as $job)
        <div class="resume-item">
          <div class="resume-item-head">
            <div>
              <div class="resume-role">{{ $job['role'] }}</div>
              <div class="resume-org">{{ $job['org'] }}</div>
            </div>
            <span class="resume-period">{{ $job['period'] }}</span>
          </div>
          <ul class="resume-points">
            @foreach ($job['points'] as $point)
              <li>{{ $point }}</li>
            @endforeach
          </ul>
        </div>
      @endforeach
    </div>

    {{-- Education --}}
    <div class="resume-block">
      <h2 class="resume-heading">Education</h2>
      @foreach ($education as $edu)
        <div class="resume-item">
          <div class="resume-item-head">
            <div>
              <div class="resume-role">{{ $edu['school'] }}</div>
              <div class="resume-org">{{ $edu['detail'] }} · {{ $edu['location'] }}</div>
            </div>
            <span class="resume-period">{{ $edu['period'] }}</span>
          </div>
        </div>
      @endforeach
    </div>

    {{-- Skills --}}
    <div class="resume-block">
      <h2 class="resume-heading">Skills</h2>
      <div class="skills-wrap">
        @foreach ($skills as $skill)
          <span class="skill-pill">{{ $skill }}</span>
        @endforeach
      </div>
    </div>

    {{-- Contact --}}
    <div class="resume-block">
      <h2 class="resume-heading">Contact</h2>
      <div class="org-list">
        @foreach ($contacts as $contact)
          <div class="contact-item">
            @include('partials.icon', ['name' => $contact['icon']])
            {{ $contact['text'] }}
          </div>
        @endforeach
      </div>
    </div>
  </section>

@endsection
