<?php

namespace Database\Seeders;

use App\Models\Course;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CourseSeeder extends Seeder
{
    public function run(): void
    {
        // Tạo thư mục nếu chưa có
        Storage::disk('public')->makeDirectory('courses');
        
        $courses = [
            [
                'name' => 'Laravel 11 Mastery',
                'price' => 499000,
                'description' => 'Khóa học Laravel từ cơ bản đến nâng cao',
                'status' => 'published',
            ],
            [
                'name' => 'PHP Advanced Programming',
                'price' => 399000,
                'description' => 'Nâng cao kỹ năng PHP với OOP, Design Patterns',
                'status' => 'published',
            ],
            [
                'name' => 'Vue.js 3 Complete Guide',
                'price' => 449000,
                'description' => 'Học Vue.js 3 từ cơ bản đến nâng cao',
                'status' => 'draft',
            ],
            [
                'name' => 'React with Hooks',
                'price' => 599000,
                'description' => 'React hiện đại với Hooks, Context API',
                'status' => 'published',
            ],
        ];
        
        foreach ($courses as $courseData) {
            Course::create([
                'name' => $courseData['name'],
                'slug' => Str::slug($courseData['name']),
                'price' => $courseData['price'],
                'description' => $courseData['description'],
                'image' => null, // Không có ảnh, sẽ dùng placeholder
                'status' => $courseData['status'],
            ]);
        }
    }
}