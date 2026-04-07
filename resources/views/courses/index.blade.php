@extends('layouts.master')

@section('title', 'Danh sách khóa học')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Danh sách khóa học</h1>
    <a href="{{ route('courses.create') }}" class="btn btn-primary">Thêm khóa học</a>
</div>

<div class="row">
    @forelse($courses as $course)
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $course->name }}</h5>
                    <p class="card-text">{{ number_format($course->price) }}đ</p>
                    <p class="card-text">
                        @if($course->status == 'published')
                            <span class="badge bg-success">Đã xuất bản</span>
                        @else
                            <span class="badge bg-warning">Nháp</span>
                        @endif
                    </p>
                    <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-primary">Xem</a>
                    <a href="{{ route('courses.edit', $course) }}" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="{{ route('courses.destroy', $course) }}" method="POST" class="d-inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    @empty
        <div class="col-12">
            <div class="alert alert-info">Chưa có khóa học nào.</div>
        </div>
    @endforelse
</div>

<div class="d-flex justify-content-center">
    {{ $courses->links() }}
</div>
@endsection