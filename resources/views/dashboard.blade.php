@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-12">
            <h1 class="mt-4">Dashboard</h1>
            <hr>
            
            <div class="row">
                <div class="col-md-3">
                    <div class="card bg-primary text-white">
                        <div class="card-body">
                            <h5>Tổng khóa học</h5>
                            <h2>{{ $totalCourses }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Tổng học viên</h5>
                            <h2>{{ $totalStudents }}</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5>Tổng doanh thu</h5>
                            <h2>{{ number_format($totalRevenue) }}đ</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5>Khóa học hot nhất</h5>
                            <h6>{{ $mostPopularCourse ? $mostPopularCourse->name : 'Chưa có' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>5 Khóa học mới nhất</h5>
                </div>
                <div class="card-body">
                    @if($latestCourses->count() > 0)
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Tên khóa học</th>
                                    <th>Giá</th>
                                    <th>Bài học</th>
                                    <th>Ngày tạo</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latestCourses as $course)
                                    <tr>
                                        <td>{{ $course->name }}</td>
                                        <td>{{ number_format($course->price) }}đ</td>
                                        <td>{{ $course->lessons->count() }}</td>
                                        <td>{{ $course->created_at->format('d/m/Y') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p>Chưa có khóa học nào</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection