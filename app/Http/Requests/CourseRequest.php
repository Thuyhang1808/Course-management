<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $courseId = $this->route('course'); // Lấy ID từ route model binding
        
        return [
            'name'        => 'required|min:3|max:255',  // Dùng 'name' như migration
            'price'       => 'required|numeric|min:0',
            'description' => 'required|string|max:2000',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'status'      => 'required|in:draft,published',
            'slug'        => 'nullable|unique:courses,slug,' . $courseId,
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => 'Tên khóa học không được để trống.',
            'name.min'           => 'Tên khóa học phải có ít nhất 3 ký tự.',
            'price.required'     => 'Giá không được để trống.',
            'price.numeric'      => 'Giá phải là số.',
            'price.min'          => 'Giá phải lớn hơn hoặc bằng 0.',
            'description.required' => 'Mô tả không được để trống.',
            'status.required'    => 'Vui lòng chọn trạng thái.',
            'status.in'          => 'Trạng thái không hợp lệ.',
            'image.image'        => 'File phải là ảnh.',
            'image.max'          => 'Ảnh không được vượt quá 2MB.',
            'slug.unique'        => 'Slug đã tồn tại, vui lòng chọn tên khác.',
        ];
    }
}