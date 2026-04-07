<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LessonController extends Controller
{
    public function index(Course $course)
    {
        $lessons = $course->lessons()->orderBy('order')->get();
        return view('lessons.index', compact('course', 'lessons'));
    }

    public function create(Course $course)
    {
        return view('lessons.create', compact('course'));
    }

    public function store(Request $request, Course $course)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->all();
        $data['course_id'] = $course->id;
        
        Lesson::create($data);
        
        return redirect()->route('courses.lessons.index', $course)
            ->with('success', 'Bài học đã được thêm thành công!');
    }

    public function edit(Lesson $lesson)
    {
        return view('lessons.edit', compact('lesson'));
    }

    public function update(Request $request, Lesson $lesson)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'video_url' => 'nullable|url',
            'order' => 'nullable|integer'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $lesson->update($request->all());
        
        return redirect()->route('courses.lessons.index', $lesson->course)
            ->with('success', 'Bài học đã được cập nhật thành công!');
    }

    public function destroy(Lesson $lesson)
    {
        $course = $lesson->course;
        $lesson->delete();
        
        return redirect()->route('courses.lessons.index', $course)
            ->with('success', 'Bài học đã được xóa thành công!');
    }
}