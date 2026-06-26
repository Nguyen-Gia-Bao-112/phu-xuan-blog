{{-- resources/views/components/alert.blade.php --}}

@props([
    'type' => 'info',   // 'success', 'danger', 'warning', 'info'
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

    {{-- Named slot: $title – chỉ render nếu caller truyền vào --}}
    @if ($title->isNotEmpty())
        <h4 class="alert-heading">{{ $title }}</h4>
        <hr>
    @endif

    {{-- Default slot: $slot – nội dung chính --}}
    {{ $slot }}

    @if ($dismissible)
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
    @endif

</div>