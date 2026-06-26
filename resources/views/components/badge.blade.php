{{-- resources/views/components/badge.blade.php --}}

{{--
    @props: khai báo các thuộc tính (props) mà component này nhận
    Cú pháp: @props(['tên-prop' => 'giá-trị-mặc-định'])
    Nếu không truyền prop khi dùng component → dùng giá trị mặc định --}}
@props([
    'status' => 'draft',   // Mặc định là 'draft' nếu không truyền
])

{{--
    Dùng @php...@endphp để xử lý logic PHP trong Blade
    Map status → class Bootstrap và label tiếng Việt --}}
@php
    $config = match($status) {
        'published' => ['class' => 'bg-success',          'label' => '✅ Đã xuất bản'],
        'draft'     => ['class' => 'bg-warning text-dark', 'label' => '📝 Bản nháp'],
        'archived'  => ['class' => 'bg-secondary',        'label' => '📦 Lưu trữ'],
        default     => ['class' => 'bg-light text-dark',  'label' => '❓ ' . $status],
    };
@endphp

{{-- Render badge với class và label tương ứng --}}
<span class="badge {{ $config['class'] }}">
    {{ $config['label'] }}
</span>