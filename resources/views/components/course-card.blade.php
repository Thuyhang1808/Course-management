<div class="card h-100 shadow-sm">
    @if($course->image)
        <img src="{{ Storage::url($course->image) }}" class="card-img-top" alt="{{ $course->name }}" style="height: 200px; object-fit: cover;">
    @else
        <div class="card-img-top bg-secondary d-flex align-items-center justify-content-center" style="height: 200px;">
            <i class="fas fa-image fa-3x text-white"></i>
        </div>
    @endif
    <div class="card-body">
        <h5 class="card-title">{{ Str::limit($course->name, 50) }}</h5>
        <p class="card-text text-muted">{{ Str::limit($course->description, 100) }}</p>
        <div class="d-flex justify-content-between align-items-center">
            <span class="h5 text-primary">{{ number_format($course->price) }}đ</span>
            @include('components.status-badge', ['status' => $course->status])
        </div>
        <div class="mt-2">
            <small class="text-muted">
                <i class="fas fa-video"></i> {{ $course->lessons_count }} bài học
            </small>
        </div>
    </div>
    <div class="card-footer bg-transparent">
        <a href="{{ route('courses.show', $course) }}" class="btn btn-sm btn-outline-primary">Xem chi tiết</a>
    </div>
</div>