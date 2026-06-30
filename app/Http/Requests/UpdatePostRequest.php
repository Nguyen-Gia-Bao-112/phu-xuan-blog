<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // Lấy post từ route parameter (Route Model Binding)
        $post = $this->route('post');

        return [
            'title'       => ['required', 'string', 'min:5', 'max:255'],
            'content'     => ['required', 'string', 'min:10'],
            'category_id' => ['required', 'exists:categories,id'],
            'tags'        => ['nullable', 'array'],
            'tags.*'      => ['exists:tags,id'],
            // Nếu bạn muốn cho phép sửa slug, có thể thêm:
            // 'slug' => ['required', 'string', Rule::unique('posts')->ignore($post->id)],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'    => 'Tiêu đề bài viết không được để trống.',
            'title.min'         => 'Tiêu đề phải có ít nhất :min ký tự.',
            'title.max'         => 'Tiêu đề không được vượt quá :max ký tự.',
            'content.required'  => 'Nội dung bài viết không được để trống.',
            'content.min'       => 'Nội dung phải có ít nhất :min ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục cho bài viết.',
            'category_id.exists'   => 'Danh mục được chọn không tồn tại trong hệ thống.',
            'tags.array'        => 'Tags phải là danh sách hợp lệ.',
            'tags.*.exists'     => 'Một hoặc nhiều tag không tồn tại trong hệ thống.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title'       => 'tiêu đề',
            'content'     => 'nội dung',
            'category_id' => 'danh mục',
            'tags'        => 'tags',
        ];
    }
}