

<?php $__env->startSection('title', $course->name); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2"><?php echo e($course->name); ?></h1>
    <div>
        <a href="<?php echo e(route('courses.edit', $course)); ?>" class="btn btn-warning">Sửa</a>
        <a href="<?php echo e(route('courses.index')); ?>" class="btn btn-secondary">Quay lại</a>
    </div>
</div>

<div class="card">
    <div class="card-body">
        <p><strong>Giá:</strong> <?php echo e(number_format($course->price)); ?>đ</p>
        <p><strong>Trạng thái:</strong> 
            <?php if($course->status == 'published'): ?>
                <span class="badge bg-success">Đã xuất bản</span>
            <?php else: ?>
                <span class="badge bg-warning">Nháp</span>
            <?php endif; ?>
        </p>
        <p><strong>Mô tả:</strong></p>
        <p><?php echo e($course->description); ?></p>
        <p><strong>Số bài học:</strong> <?php echo e($course->lessons->count()); ?></p>
        <p><strong>Số học viên:</strong> <?php echo e($course->students->count()); ?></p>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PHP Laravel\course-management\resources\views/courses/show.blade.php ENDPATH**/ ?>