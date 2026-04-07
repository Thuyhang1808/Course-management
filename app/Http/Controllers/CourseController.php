<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Http\Requests\CourseRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    public function dashboard()
    {
        $totalCourses = Course::count();
        $totalStudents = \App\Models\Student::count();
        $totalRevenue = Course::published()->get()->sum(function($course) {
            return $course->price * $course->students->count();
        });
        
        $mostPopularCourse = Course::withCount('students')
            ->orderBy('students_count', 'desc')
            ->first();
            
        $latestCourses = Course::with('lessons')
            ->latest()
            ->take(5)
            ->get();
            
        return view('dashboard', compact('totalCourses', 'totalStudents', 'totalRevenue', 'mostPopularCourse', 'latestCourses'));
    }

    public function index(Request $request)
    {
        $query = Course::with(['lessons', 'students']);
        
        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }
        
        if ($request->filled('sort')) {
            switch($request->sort) {
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'students_asc':
                    $query->withCount('students')->orderBy('students_count', 'asc');
                    break;
                case 'students_desc':
                    $query->withCount('students')->orderBy('students_count', 'desc');
                    break;
                case 'newest':
                    $query->latest();
                    break;
                default:
                    $query->latest();
            }
        } else {
            $query->latest();
        }
        
        $courses = $query->paginate(10);
        
        return view('courses.index', compact('courses'));
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('courses', 'public');
        }
        
        Course::create($data);
        
        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được tạo thành công!');
    }

    public function show(Course $course)
    {
        $course->load(['lessons' => function($q) {
            $q->orderBy('order');
        }, 'students']);
        
        return view('courses.show', compact('course'));
    }

    public function edit(Course $course)
    {
        return view('courses.edit', compact('course'));
    }

    public function update(CourseRequest $request, Course $course)
    {
        $data = $request->validated();
        
        if ($request->hasFile('image')) {
            if ($course->image) {
                Storage::disk('public')->delete($course->image);
            }
            $data['image'] = $request->file('image')->store('courses', 'public');
        }
        
        $course->update($data);
        
        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được cập nhật thành công!');
    }

    public function destroy(Course $course)
    {
        $course->delete();
        
        return redirect()->route('courses.index')
            ->with('success', 'Khóa học đã được xóa thành công!');
    }

    public function trashed()
    {
        $courses = Course::onlyTrashed()->with(['lessons', 'students'])->paginate(10);
        return view('courses.trashed', compact('courses'));
    }

    public function restore($id)
    {
        $course = Course::onlyTrashed()->findOrFail($id);
        $course->restore();
        
        return redirect()->route('courses.trashed')
            ->with('success', 'Khóa học đã được khôi phục thành công!');
    }
}