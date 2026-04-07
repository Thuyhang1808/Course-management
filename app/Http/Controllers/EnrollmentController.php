<?php

namespace App\Http\Controllers;

use App\Models\Course;
use App\Models\Student;
use App\Models\Enrollment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class EnrollmentController extends Controller
{
    public function index(Request $request)
    {
        $query = Enrollment::with(['course', 'student']);
        
        if ($request->filled('course_id')) {
            $query->where('course_id', $request->course_id);
        }
        
        $enrollments = $query->latest()->paginate(15);
        $courses = Course::all();
        
        return view('enrollments.index', compact('enrollments', 'courses'));
    }

    public function create()
    {
        $courses = Course::published()->get();
        return view('enrollments.create', compact('courses'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'course_id' => 'required|exists:courses,id',
            'student_name' => 'required|string|max:255',
            'student_email' => 'required|email|unique:students,email'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Find or create student
        $student = Student::firstOrCreate(
            ['email' => $request->student_email],
            ['name' => $request->student_name]
        );
        
        // Check if already enrolled
        $existing = Enrollment::where('course_id', $request->course_id)
            ->where('student_id', $student->id)
            ->first();
            
        if ($existing) {
            return redirect()->back()
                ->with('error', 'Học viên đã đăng ký khóa học này rồi!')
                ->withInput();
        }
        
        // Create enrollment
        Enrollment::create([
            'course_id' => $request->course_id,
            'student_id' => $student->id,
            'enrolled_date' => now()
        ]);
        
        return redirect()->route('enrollments.index')
            ->with('success', 'Đăng ký khóa học thành công!');
    }

    public function destroy(Enrollment $enrollment)
    {
        $enrollment->delete();
        
        return redirect()->route('enrollments.index')
            ->with('success', 'Đã hủy đăng ký khóa học!');
    }
}