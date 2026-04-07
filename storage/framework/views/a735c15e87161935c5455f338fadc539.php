

<?php $__env->startSection('title', 'Danh sách khóa học'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">Danh sách khóa học</h1>
    <a href="<?php echo e(route('courses.create')); ?>" class="btn btn-primary">Thêm khóa học</a>
</div>

<div class="row">
    <?php $__empty_1 = true; $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
        <div class="col-md-4 mb-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title"><?php echo e($course->name); ?></h5>
                    <p class="card-text"><?php echo e(number_format($course->price)); ?>đ</p>
                    <p class="card-text">
                        <?php if($course->status == 'published'): ?>
                            <span class="badge bg-success">Đã xuất bản</span>
                        <?php else: ?>
                            <span class="badge bg-warning">Nháp</span>
                        <?php endif; ?>
                    </p>
                    <a href="<?php echo e(route('courses.show', $course)); ?>" class="btn btn-sm btn-primary">Xem</a>
                    <a href="<?php echo e(route('courses.edit', $course)); ?>" class="btn btn-sm btn-warning">Sửa</a>
                    <form action="<?php echo e(route('courses.destroy', $course)); ?>" method="POST" class="d-inline">
                        <?php echo csrf_field(); ?>
                        <?php echo method_field('DELETE'); ?>
                        <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Xóa?')">Xóa</button>
                    </form>
                </div>
            </div>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
        <div class="col-12">
            <div class="alert alert-info">Chưa có khóa học nào.</div>
        </div>
    <?php endif; ?>
</div>

<div class="d-flex justify-content-center">
    <?php echo e($courses->links()); ?>

</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PHP Laravel\course-management\resources\views/courses/index.blade.php ENDPATH**/ ?>