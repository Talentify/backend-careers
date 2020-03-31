<?php $__env->startSection('content'); ?>
    <div class="form-title">
        <h1><?php echo e($title); ?></h1>
    </div>
    <hr>

    <?php if($errors->any()): ?>
        <div class="alert alert-danger">
            <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <p><?php echo e($error); ?></p>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($message)): ?>
        <div class="errorMessage">
            <span class="alert <?php echo e(isset($error) && $error === true ? 'alert-danger' : 'alert-success'); ?>"><?php echo e($errorMessage); ?></span>
        </div>
    <?php endif; ?>

    <div class="col-md-12">
        <?php if(isset($opportunity)): ?>
            <form method="POST" action="<?php echo e(route('admin.opportunity.update', $opportunity->id)); ?>">
        <?php else: ?>
            <form method="POST" action="<?php echo e(route('admin.opportunity.store')); ?>">
        <?php endif; ?>
            <?php echo csrf_field(); ?>

            <div class="form-group row">
                <label for="title" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Title')); ?></label>

                <div class="col-md-4">
                    <input id="title" type="text" class="form-control <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="title" value="<?php echo e(isset($opportunity) ? $opportunity->title : ''); ?>" required autofocus>

                    <?php $__errorArgs = ['title'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="description" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Description')); ?></label>

                <div class="col-md-4">
                    <textarea rows="6" id="description" class="form-control <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="description" required><?php if(isset($opportunity)): ?><?php echo e($opportunity->description); ?><?php endif; ?></textarea>

                    <?php $__errorArgs = ['description'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="status" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Status')); ?></label>

                <div class="col-md-6">
                    <div class="form-group">
                        <div class="radio">
                            <label><input type="radio" name="status" class="<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status-active" value="active" <?php echo e(isset($opportunity) && $opportunity->status === 'active' ? "checked" : ""); ?>>Active</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="status" class="<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status-paused" value="paused" <?php echo e(isset($opportunity) && $opportunity->status === 'paused' ? "checked" : ""); ?>>Paused</label>
                        </div>
                        <div class="radio">
                            <label><input type="radio" name="status" class="<?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="status-inactive" value="inactive" <?php echo e(isset($opportunity) && $opportunity->status === 'inactive' ? "checked" : ""); ?>>Inactive</label>
                        </div>
                    </div>

                    <?php $__errorArgs = ['status'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="workplace" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Workplace')); ?></label>

                <div class="col-md-4">
                    <input id="workplace" type="text" class="form-control <?php $__errorArgs = ['workplace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="workplace" value="<?php echo e(isset($opportunity) ? $opportunity->workplace : ''); ?>">

                    <?php $__errorArgs = ['workplace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="form-group row">
                <label for="salary" class="col-md-2 col-form-label text-md-right"><?php echo e(__('Salary ($/year)')); ?></label>

                <div class="col-md-3">
                    <input id="salary" class="form-control money <?php $__errorArgs = ['salary'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?> is-invalid <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>" name="salary" value="<?php echo e(isset($opportunity) ? $opportunity->salary : ''); ?>">

                    <?php $__errorArgs = ['workplace'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <span class="invalid-feedback" role="alert">
                        <strong><?php echo e($message); ?></strong>
                    </span>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
            </div>

            <div class="container">
                <div class="form-group row">
                    <div class="col-md-12 text-center row">
                        <div class="col-md-6">
                            <a href="<?php echo e(route('admin.home')); ?>" class="btn btn-secondary float-left">
                                <?php echo e(__('Cancel')); ?>

                            </a>
                        </div>
                        <div class="col-md-6">
                            <button type="submit" class="btn btn-primary float-right">
                                <?php echo e(__('Save opportunity')); ?>

                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

    <script src="//code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="<?php echo e(asset('js/simple.money.format.js')); ?>"></script>

    <script>
        $(document).ready(function() {
            $('.money').simpleMoneyFormat();
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/talentify/resources/views/admin/opportunity/create_edit.blade.php ENDPATH**/ ?>
