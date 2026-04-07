@extends('layouts.master')

@section('title', 'Đăng ký khóa học')

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Danh sách đăng ký</h1>
    <a href="{{ route('enrollments.create') }}" class="btn btn-primary">Đăng ký mới</a>
</div>

<div class="card">
    <div class="card-body">
        <table class="table">
            <thead>
                <tr><th>STT</th><th>Khóa học</th><th>Học viên</th><th>Email</th><th>Ngày đăng ký</th><th>Thao tác</th></tr>
            </thead>
            <tbody>
                @forelse($enrollments as $index => $enrollment)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $enrollment->course->name }}</td>
                    <td>{{ $enrollment->student->name }}</td>
                    <td>{{ $enrollment->student->email }}</td>
                    <td>{{ $enrollment->enrolled_date->format('d/m/Y') }}</td>
                    <td>
                        <form action="{{ route('enrollments.destroy', $enrollment) }}" method="POST">
                            @csrf @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Hủy?')">Hủy</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="6">Chưa có đăng ký nào</td></tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection