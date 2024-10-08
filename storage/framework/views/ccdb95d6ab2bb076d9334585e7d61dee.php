<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('click', '.code', function () {
            var type = $(this).val();
            if (type == 'manual') {
                $('#manual').removeClass('d-none');
                $('#manual').addClass('d-block');
                $('#auto').removeClass('d-block');
                $('#auto').addClass('d-none');

                // Clear the value of the auto-generated code field
                $('#auto-code').val('');
            } else {
                $('#auto').removeClass('d-none');
                $('#auto').addClass('d-block');
                $('#manual').removeClass('d-block');
                $('#manual').addClass('d-none');

                // Clear the value of the manual code field
                $('#manual').val('');
            }
        });

        $(document).on('click', '#code-generate', function () {
            var length = 10;
            var result = '';
            var characters = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
            var charactersLength = characters.length;
            for (var i = 0; i < length; i++) {
                result += characters.charAt(Math.floor(Math.random() * charactersLength));
            }
            $('#auto-code').val(result);
        });
    </script>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Coupon')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Coupon')); ?></li>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
<div class="action-btn bg-warning ms-2">
    <a href="#" data-url="<?php echo e(route('coupon.create')); ?>" data-size="md" data-ajax-popup="true" data-title="<?php echo e(__('Create New Coupon')); ?>" title="<?php echo e(__('Create')); ?>" class="btn btn-sm btn-primary btn-icon m-1" data-bs-toggle="tooltip">
        <i class="ti ti-plus"></i>
    </a>
</div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive overflow_hidden">
                            <table id="datatable" class="table datatable align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name"> <?php echo e(__('Name')); ?></th>
                                        <th scope="col" class="sort" data-sort="budget"><?php echo e(__('Code')); ?></th>
                                        <th scope="col" class="sort" data-sort="status"><?php echo e(__('Discount (%)')); ?></th>
                                        <th scope="col"><?php echo e(__('Limit')); ?></th>
                                        <th scope="col" class="sort" data-sort="completion"> <?php echo e(__('Used')); ?></th>
                                        <th scope="col" class="action text-end"><?php echo e(__('Action')); ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $coupons; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $coupon): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td class="budget"><?php echo e($coupon->name); ?> </td>
                                            <td><?php echo e($coupon->code); ?></td>
                                            <td>
                                                <?php echo e($coupon->discount); ?>

                                            </td>
                                            <td><?php echo e($coupon->limit); ?></td>
                                            <td><?php echo e($coupon->used_coupon()); ?></td>
                                            <td class="text-end">
                                                <div class="actions ml-3">
                                                    <div class="action-btn bg-warning ms-2">
                                                        <a href="<?php echo e(route('coupon.show',$coupon->id)); ?>" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-bs-toggle="tooltip" data-title="<?php echo e(__('Coupon Details')); ?>" title="<?php echo e(__('View')); ?>">
                                                            <i class="ti ti-eye"></i>
                                                        </a>
                                                    </div>

                                                    <div class="action-btn bg-info ms-2">
                                                        <a href="#!" class="mx-3 btn btn-sm d-inline-flex align-items-center text-white" data-size="md" data-url="<?php echo e(route('coupon.edit',$coupon->id)); ?>" data-ajax-popup="true" data-title="<?php echo e(__('Edit Coupon')); ?>" data-bs-toggle="tooltip"title="<?php echo e(__('Edit')); ?>">
                                                            <i class="ti ti-edit"></i>
                                                        </a>
                                                    </div>

                                                    <div class="action-btn bg-danger ms-2">
                                                        <?php echo Form::open(['method' => 'DELETE', 'route' => ['coupon.destroy', $coupon->id]]); ?>

                                                            <a href="#!" class="mx-3 btn btn-sm  align-items-center text-white show_confirm" data-bs-toggle="tooltip" title='Delete'>
                                                                <i class="ti ti-trash"></i>
                                                            </a>
                                                        <?php echo Form::close(); ?>

                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>


<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/coupon/index.blade.php ENDPATH**/ ?>