{{-- resources/views/partials/footer.blade.php --}}

<footer class="bg-dark text-light mt-5 py-4">
    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h6 class="fw-bold">📝 Phú Xuân Blog</h6>
                <p class="text-muted small mb-0">
                    Dự án thực hành môn IT3042 – Lập trình Backend Laravel
                </p>
            </div>
            <div class="col-md-6 text-md-end">
                <p class="text-muted small mb-0">
                    © {{ date('Y') }} Đại học Phú Xuân – Khoa CNTT
                </p>
                {{--
                    date('Y') là hàm PHP trả về năm hiện tại.
                    Blade cho phép dùng bất kỳ hàm PHP nào trong {{ }}
                --}}
            </div>
        </div>
    </div>
</footer>