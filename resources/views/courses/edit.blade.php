@extends('layouts.master')

@section('title', 'Sửa khóa học')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Sửa khóa học: {{ $course->name }}</h1>
    <a href="{{ route('courses.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-body">
        <form action="{{ route('courses.update', $course) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-3">
                <label>Tên khóa học</label>
                <input type="text" name="name" class="form-control" value="{{ $course->name }}" required>
            </div>
            <div class="mb-3">
                <label>Giá</label>
                <input type="number" name="price" class="form-control" value="{{ $course->price }}" required>
            </div>
            <div class="mb-3">
                <label>Mô tả</label>
                <textarea name="description" class="form-control" rows="5" required>{{ $course->description }}</textarea>
            </div>
            <div class="mb-3">
                <label>Trạng thái</label>
                <select name="status" class="form-control">
                    <option value="draft" {{ $course->status == 'draft' ? 'selected' : '' }}>Nháp</option>
                    <option value="published" {{ $course->status == 'published' ? 'selected' : '' }}>Xuất bản</option>
                </select>
            </div>
            <div class="mb-3">
                <label>Ảnh</label>
                <input type="file" name="image" class="form-control">
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
        </form>
    </div>
</div>
@endsection