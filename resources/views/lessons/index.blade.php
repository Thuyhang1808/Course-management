@extends('layouts.master')

@section('title', 'Bài học - ' . $course->name)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Bài học: {{ $course->name }}</h1>
    <div>
        <a href="{{ route('courses.lessons.create', $course) }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm bài học
        </a>
        <a href="{{ route('courses.show', $course) }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($lessons->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>STT</th>
                        <th>Tiêu đề</th>
                        <th>Nội dung</th>
                        <th>Video URL</th>
                        <th>Thứ tự</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($lessons as $index => $lesson)
                        <tr>
                            <td>{{ $index + 1 }}</td>
                            <td>{{ $lesson->title }}</td>
                            <td>{{ Str::limit($lesson->content, 50) }}</td>
                            <td>
                                @if($lesson->video_url)
                                    <a href="{{ $lesson->video_url }}" target="_blank">Xem video</a>
                                @else
                                    <span class="text-muted">Chưa có</span>
                                @endif
                            </td>
                            <td>{{ $lesson->order }}</td>
                            <td>
                                <a href="{{ route('lessons.edit', $lesson) }}" class="btn btn-sm btn-warning">Sửa</a>
                                <form action="{{ route('lessons.destroy', $lesson) }}" method="POST" class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa bài học này?')">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <div class="alert alert-info">Chưa có bài học nào. Hãy <a href="{{ route('courses.lessons.create', $course) }}">thêm bài học</a>.</div>
        @endif
    </div>
</div>
@endsection