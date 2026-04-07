@extends('layouts.master')

@section('title', $course->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{ $course->name }}</h1>
    <div>
        <a href="{{ route('courses.edit', $course) }}" class="btn btn-warning">Sửa</a>
        <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p><strong>Giá:</strong> {{ number_format($course->price) }}đ</p>
        <p><strong>Trạng thái:</strong> 
            @if($course->status == 'published')
                <span class="badge bg-success">Đã xuất bản</span>
            @else
                <span class="badge bg-warning">Nháp</span>
            @endif
        </p>
        <p><strong>Mô tả:</strong></p>
        <p>{{ $course->description }}</p>
        <p><strong>Số bài học:</strong> {{ $course->lessons->count() }}</p>
        <p><strong>Số học viên:</strong> {{ $course->students->count() }}</p>
    </div>
</div>
@endsection