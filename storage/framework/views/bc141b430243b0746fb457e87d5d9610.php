<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('User')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Plan Request')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan Request')); ?></li>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="row">
        <div class="col-sm-12">
            <div class="row">
                <div class="card">
                    <div class="card-body table-border-style">
                        <div class="table-responsive">
                            <table class="table datatable" id="pc-dt-simple">
                                <thead>

                                </thead>
                                <tbody>

                                    <?php if($plan_requests->count() > 0): ?>
                                        <tr>
                                            <th><?php echo e(__('User Name')); ?></th>
                                            <th><?php echo e(__('Plan Name')); ?></th>
                                            <th><?php echo e(__('Max Users')); ?></th>
                                            <th><?php echo e(__('Max Account')); ?></th>
                                            <th><?php echo e(__('Max Contact')); ?></th>
                                            <th><?php echo e(__('Duration')); ?></th>
                                            <th><?php echo e(__('expiry date')); ?></th>
                                            <th width="150px"><?php echo e(__('Action')); ?></th>
                                        </tr>
                                        <?php $__currentLoopData = $plan_requests; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $prequest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td>
                                                    <div class="font-style font-weight-bold">
                                                        <?php echo e($prequest->user->name); ?></div>
                                                </td>
                                                <td>
                                                    <div class="font-style font-weight-bold"><?php echo e($prequest->plan->name); ?>

                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="font-weight-bold">
                                                        <?php if($prequest->plan->max_user == -1): ?>
                                                            <?php echo e(__('Unlimited Users')); ?>

                                                        <?php else: ?>
                                                            <?php echo e($prequest->plan->max_user); ?>

                                                    </div>
                                                    <div><?php echo e(__('Users')); ?></div>
                                        <?php endif; ?>
                                        </td>
                                        <td>
                                            <div class="font-weight-bold">
                                                <?php if($prequest->plan->max_account == -1): ?>
                                                    <?php echo e(__('Unlimited Account')); ?>

                                                <?php else: ?>
                                                    <?php echo e($prequest->plan->max_account); ?>

                                            </div>
                                            <div><?php echo e(__('Account')); ?></div>
                                    <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="font-weight-bold">
                                            <?php if($prequest->plan->max_contact == -1): ?>
                                                <?php echo e(__('Unlimited Contact')); ?>

                                            <?php else: ?>
                                                <?php echo e($prequest->plan->max_contact); ?>

                                        </div>
                                        <div><?php echo e(__('Contact')); ?></div>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <div class="font-style font-weight-bold">
                                            <?php echo e(isset($prequest->duration) ? $prequest->duration : ''); ?></div>
                                    </td>
                                    <td><?php echo e(\App\Models\Utility::getDateFormated($prequest->created_at, true)); ?></td>
                                    <td>
                                        <div>
                                            <a href="<?php echo e(route('response.request', [$prequest->id, 1])); ?>"
                                                class="btn btn-success btn-xs">
                                                <i class="fas fa-check"></i>
                                            </a>
                                            <a href="<?php echo e(route('response.request', [$prequest->id, 0])); ?>"
                                                class="btn btn-danger btn-xs">
                                                <i class="fas fa-times"></i>
                                            </a>
                                        </div>
                                    </td>
                                    </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php else: ?>
                                    <tr>
                                        <th scope="col" colspan="7">
                                            <h6 class="text-center"><?php echo e(__('No Manually Plan Request Found.')); ?></h6>
                                        </th>
                                    </tr>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/plan_request/index.blade.php ENDPATH**/ ?>