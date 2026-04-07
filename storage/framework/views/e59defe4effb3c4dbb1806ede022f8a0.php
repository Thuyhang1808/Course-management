

<?php $__env->startSection('title', 'Dashboard'); ?>

<?php $__env->startSection('content'); ?>
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
                            <h2><?php echo e($totalCourses); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-success text-white">
                        <div class="card-body">
                            <h5>Tổng học viên</h5>
                            <h2><?php echo e($totalStudents); ?></h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-info text-white">
                        <div class="card-body">
                            <h5>Tổng doanh thu</h5>
                            <h2><?php echo e(number_format($totalRevenue)); ?>đ</h2>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card bg-warning text-white">
                        <div class="card-body">
                            <h5>Khóa học hot nhất</h5>
                            <h6><?php echo e($mostPopularCourse ? $mostPopularCourse->name : 'Chưa có'); ?></h6>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="card mt-4">
                <div class="card-header">
                    <h5>5 Khóa học mới nhất</h5>
                </div>
                <div class="card-body">
                    <?php if($latestCourses->count() > 0): ?>
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
                                <?php $__currentLoopData = $latestCourses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <tr>
                                        <td><?php echo e($course->name); ?></td>
                                        <td><?php echo e(number_format($course->price)); ?>đ</td>
                                        <td><?php echo e($course->lessons->count()); ?></td>
                                        <td><?php echo e($course->created_at->format('d/m/Y')); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>Chưa có khóa học nào</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PHP Laravel\course-management\resources\views/dashboard.blade.php ENDPATH**/ ?>