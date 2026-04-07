


<?php $__env->startSection('title', 'Quản lý đăng ký'); ?>

<?php $__env->startSection('content'); ?>
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1><i class="fas fa-users"></i> Quản lý đăng ký học</h1>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>">Dashboard</a></li>
                <li class="breadcrumb-item active">Đăng ký học</li>
            </ol>
        </nav>
    </div>
    <a href="<?php echo e(route('enrollments.create')); ?>" class="btn btn-primary">
        <i class="fas fa-plus"></i> Đăng ký mới
    </a>
</div>


<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0"><i class="fas fa-filter"></i> Lọc theo khóa học</h5>
    </div>
    <div class="card-body">
        <form method="GET" class="row g-3">
            <div class="col-md-8">
                <select name="course_id" class="form-select" onchange="this.form.submit()">
                    <option value="">-- Tất cả khóa học --</option>
                    <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <option value="<?php echo e($course->id); ?>" <?php echo e(request('course_id') == $course->id ? 'selected' : ''); ?>>
                            <?php echo e($course->name); ?> 
                            <?php if($course->status == 'draft'): ?> [Draft] <?php endif; ?>
                            (<?php echo e($course->students_count); ?> học viên)
                        </option>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </select>
            </div>
            <div class="col-md-4">
                <a href="<?php echo e(route('enrollments.index')); ?>" class="btn btn-secondary w-100">
                    <i class="fas fa-times"></i> Xóa lọc
                </a>
            </div>
        </form>
    </div>
</div>


<div class="row mb-4">
    <div class="col-md-4">
        <div class="card text-white bg-primary">
            <div class="card-body">
                <h5 class="card-title">Tổng số khóa học</h5>
                <h2 class="display-6"><?php echo e($courses->count()); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-success">
            <div class="card-body">
                <h5 class="card-title">Tổng số học viên</h5>
                <h2 class="display-6"><?php echo e($courses->sum('students_count')); ?></h2>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card text-white bg-warning">
            <div class="card-body">
                <h5 class="card-title">Tổng doanh thu</h5>
                <h2 class="display-6"><?php echo e(number_format($courseStats->sum('revenue'))); ?>đ</h2>
            </div>
        </div>
    </div>
</div>


<?php if(request('course_id') && $selectedCourse): ?>
    <div class="card">
        <div class="card-header bg-info text-white">
            <h4 class="mb-0">
                <i class="fas fa-chalkboard"></i> 
                Danh sách học viên khóa: <?php echo e($selectedCourse->name); ?>

            </h4>
        </div>
        <div class="card-body">
            <div class="alert alert-success">
                <i class="fas fa-chart-line"></i>
                <strong>Thống kê:</strong> 
                Tổng số học viên: <strong><?php echo e($selectedCourse->students->count()); ?></strong> | 
                Doanh thu: <strong><?php echo e(number_format($selectedCourse->students->count() * $selectedCourse->price)); ?>đ</strong>
            </div>
            
            <?php if($enrollments->isEmpty()): ?>
                <div class="text-center py-5">
                    <i class="fas fa-user-graduate fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Chưa có học viên nào đăng ký khóa học này</h5>
                    <a href="<?php echo e(route('enrollments.create')); ?>?course_id=<?php echo e($selectedCourse->id); ?>" class="btn btn-primary mt-3">
                        <i class="fas fa-plus"></i> Đăng ký ngay
                    </a>
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-hover">
                        <thead class="table-dark">
                            <tr>
                                <th>#</th>
                                <th><i class="fas fa-user"></i> Tên học viên</th>
                                <th><i class="fas fa-envelope"></i> Email</th>
                                <th><i class="fas fa-calendar-alt"></i> Ngày đăng ký</th>
                                <th><i class="fas fa-money-bill"></i> Học phí</th>
                                <th><i class="fas fa-cogs"></i> Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $__currentLoopData = $enrollments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $student): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $enrollment = $student->enrollments->where('course_id', $selectedCourse->id)->first();
                                ?>
                                <tr>
                                    <td><?php echo e($index + 1); ?></td>
                                    <td>
                                        <strong><?php echo e($student->name); ?></strong>
                                    </td>
                                    <td><?php echo e($student->email); ?></td>
                                    <td>
                                        <?php if($enrollment): ?>
                                            <span class="badge bg-info">
                                                <?php echo e($enrollment->enrolled_date->format('d/m/Y')); ?>

                                            </span>
                                        <?php else: ?>
                                            <span class="badge bg-secondary">N/A</span>
                                        <?php endif; ?>
                                    </td>
                                    <td class="text-danger fw-bold"><?php echo e(number_format($selectedCourse->price)); ?>đ</td>
                                    <td>
                                        <form action="<?php echo e(route('enrollments.destroy', $enrollment)); ?>" 
                                              method="POST" 
                                              class="d-inline"
                                              onsubmit="return confirm('Bạn có chắc muốn hủy đăng ký của học viên này?')">
                                            <?php echo csrf_field(); ?>
                                            <?php echo method_field('DELETE'); ?>
                                            <button type="submit" class="btn btn-sm btn-danger">
                                                <i class="fas fa-trash"></i> Hủy đăng ký
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                        <tfoot class="table-light">
                            <tr>
                                <td colspan="4" class="text-end fw-bold">Tổng cộng:</td>
                                <td class="text-danger fw-bold"><?php echo e(number_format($selectedCourse->students->count() * $selectedCourse->price)); ?>đ</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
<?php else: ?>
    
    <div class="card">
        <div class="card-header bg-light">
            <h5 class="mb-0"><i class="fas fa-chart-bar"></i> Thống kê đăng ký theo khóa học</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>#</th>
                            <th>Tên khóa học</th>
                            <th>Giá</th>
                            <th>Số học viên</th>
                            <th>Doanh thu</th>
                            <th>Trạng thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $__currentLoopData = $courseStats; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td><?php echo e($index + 1); ?></td>
                                <td>
                                    <strong><?php echo e($course->name); ?></strong>
                                    <br>
                                    <small class="text-muted"><?php echo e(Str::limit($course->description, 50)); ?></small>
                                </td>
                                <td class="text-danger"><?php echo e(number_format($course->price)); ?>đ</td>
                                <td>
                                    <span class="badge bg-primary">
                                        <i class="fas fa-users"></i> <?php echo e($course->students_count); ?>

                                    </span>
                                </td>
                                <td class="text-success fw-bold"><?php echo e(number_format($course->revenue)); ?>đ</td>
                                <td>
                                    <?php if (isset($component)) { $__componentOriginal8c81617a70e11bcf247c4db924ab1b62 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.status-badge','data' => ['status' => $course->status]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('status-badge'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['status' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($course->status)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $attributes = $__attributesOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__attributesOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62)): ?>
<?php $component = $__componentOriginal8c81617a70e11bcf247c4db924ab1b62; ?>
<?php unset($__componentOriginal8c81617a70e11bcf247c4db924ab1b62); ?>
<?php endif; ?>
                                </td>
                                <td>
                                    <a href="<?php echo e(route('enrollments.index', ['course_id' => $course->id])); ?>" 
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Xem chi tiết
                                    </a>
                                    <a href="<?php echo e(route('courses.show', $course)); ?>" 
                                       class="btn btn-sm btn-secondary">
                                        <i class="fas fa-book"></i> Xem khóa học
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </tbody>
                    <tfoot class="table-light">
                        <tr>
                            <td colspan="3" class="text-end fw-bold">Tổng cộng:</td>
                            <td class="fw-bold"><?php echo e($courseStats->sum('students_count')); ?> học viên</td>
                            <td class="fw-bold text-success"><?php echo e(number_format($courseStats->sum('revenue'))); ?>đ</td>
                            <td colspan="2"></td>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
    
    
    <div class="card mt-4">
        <div class="card-header bg-warning text-dark">
            <h5 class="mb-0"><i class="fas fa-fire"></i> Top 5 khóa học có nhiều học viên nhất</h5>
        </div>
        <div class="card-body">
            <div class="row">
                <?php $__currentLoopData = $courseStats->sortByDesc('students_count')->take(5); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="col-md-6 mb-3">
                        <div class="card border-primary">
                            <div class="card-body">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h6 class="card-title"><?php echo e($course->name); ?></h6>
                                        <p class="card-text text-muted small"><?php echo e($course->students_count); ?> học viên</p>
                                    </div>
                                    <div class="text-end">
                                        <span class="badge bg-primary rounded-pill">
                                            <?php echo e($loop->iteration); ?>

                                        </span>
                                    </div>
                                </div>
                                <div class="progress mt-2">
                                    <?php
                                        $maxStudents = $courseStats->max('students_count');
                                        $percentage = $maxStudents > 0 ? ($course->students_count / $maxStudents) * 100 : 0;
                                    ?>
                                    <div class="progress-bar bg-success" 
                                         role="progressbar" 
                                         style="width: <?php echo e($percentage); ?>%" 
                                         aria-valuenow="<?php echo e($percentage); ?>" 
                                         aria-valuemin="0" 
                                         aria-valuemax="100">
                                        <?php echo e(round($percentage)); ?>%
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\PHP Laravel\course-management\resources\views/enrollments/index.blade.php ENDPATH**/ ?>