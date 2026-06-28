@props([
    'type' => 'info',
    'dismissible' => false,
])

@php
    $colorClass = match($type) {
        'success' => 'alert-success',
        'danger'  => 'alert-danger',
        'warning' => 'alert-warning',
        default   => 'alert-info',
    };
@endphp

<div class="alert {{ $colorClass }} {{ $dismissible ? 'alert-dismissible fade show' : '' }}"
     role="alert">

    @if (isset($title) && $title->isNotEmpty())
        <h4 class="alert-heading">{{ $title }}</h4>
        <hr>
    @endif

    {{ $slot }}

    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    @endif
</div>