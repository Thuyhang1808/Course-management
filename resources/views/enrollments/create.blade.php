@extends('layouts.master')

@section('title', 'Đăng ký khóa học')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Đăng ký khóa học</h1>
    <a href="{{ route('enrollments.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('enrollments.store') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Chọn khóa học</label>
                <select name="course_id" class="form-control" required>
                    <option value="">-- Chọn --</option>
                    @foreach($courses as $course)
                    <option value="{{ $course->id }}">{{ $course->name }} - {{ number_format($course->price) }}đ</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label>Tên học viên</label>
                <input type="text" name="student_name" class="form-control" required>
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="student_email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Đăng ký</button>
        </form>
    </div>
</div>
@endsection