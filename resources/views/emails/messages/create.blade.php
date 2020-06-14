@component('mail::message')
# Monsieur / Madame <br>
<ul>
      <li>  {{ $nom }}
      <li>  {{ $email }}
</ul>


@component('mail::panel')
{{ $text }}

@endcomponent

Merci,<br>
{{ config('app.name') }}
@endcomponent
