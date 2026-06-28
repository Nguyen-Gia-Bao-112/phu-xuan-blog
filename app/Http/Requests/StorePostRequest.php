<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePostRequest extends FormRequest
{
    /**
     * Ai được phép gửi request này?
     * true = tất cả (lab demo)
     */
    public function authorize(): bool
    {
        return true;  // ⚠ PHẢI ĐỔI THÀNH true!
    }

    /**
     * Quy tắc validation
     */
    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'min:5', 'max:255'],
            'content' => ['required', 'string', 'min:10'],
        ];
    }

    /**
     * Thông báo lỗi tùy chỉnh (tiếng Việt)
     */
    public function messages(): array
    {
        return [
            'title.required'   => 'Tiêu đề bài viết không được để trống.',
            'title.min'        => 'Tiêu đề phải có ít nhất :min ký tự.',
            'title.max'        => 'Tiêu đề không được vượt quá :max ký tự.',
            'content.required' => 'Nội dung bài viết không được để trống.',
            'content.min'      => 'Nội dung phải có ít nhất :min ký tự.',
        ];
    }

    /**
     * Tên hiển thị của field trong lỗi mặc định
     */
    public function attributes(): array
    {
        return [
            'title'   => 'tiêu đề',
            'content' => 'nội dung',
        ];
    }
}