@php
    $user = auth()->check() ? auth()->user() : null;
@endphp

<div class="card">
    <div class="card-body p-4 py-5 text-center">
        <span class="avatar avatar-xl mb-4 avatar-rounded bg-azure text-white">{{ $user->initials }}</span>
        <h3 class="mb-0">{{ __('Good :time, :user!', ['time' => timeOfDay(), 'user' => $user->name]) }}</h3>
        <p class="text-muted">{{ $user->email }}</p>
        <p class="text-muted">{{ \Athphane\ProgrammerQuotes\ProgrammerQuotes::random() }}</p>
    </div>
</div>
