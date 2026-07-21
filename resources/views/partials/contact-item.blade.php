{{-- One contact row. Renders as a link when the contact has a url, otherwise
     as plain text. Usage: @include('partials.contact-item') inside a loop
     that provides $contact. --}}
@if (!empty($contact['url']))
  <a class="contact-item" href="{{ $contact['url'] }}"
     @unless (str_starts_with($contact['url'], 'mailto:')) target="_blank" rel="noopener" @endunless>
    @include('partials.icon', ['name' => $contact['icon']])
    {{ $contact['text'] }}
  </a>
@else
  <div class="contact-item">
    @include('partials.icon', ['name' => $contact['icon']])
    {{ $contact['text'] }}
  </div>
@endif
