<?php
    $dir = asset(Storage::url('uploads/plan'));
    $settings = Utility::settings();
?>
<?php $__env->startPush('script-page'); ?>
<?php $__env->stopPush(); ?>
<?php $__env->startSection('page-title'); ?>
    <?php echo e(__('Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('title'); ?>
    <?php echo e(__('Plan')); ?>

<?php $__env->stopSection(); ?>
<?php $__env->startSection('breadcrumb'); ?>
    <li class="breadcrumb-item"><a href="<?php echo e(route('dashboard')); ?>"><?php echo e(__('Home')); ?></a></li>
    <li class="breadcrumb-item"><?php echo e(__('Plan')); ?></li>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('action-btn'); ?>
    <?php if(\Auth::user()->type == 'super admin'): ?>
        <div class="action-btn ms-2">
            <a href="#" data-url="<?php echo e(route('plan.create')); ?>" data-size="md" data-ajax-popup="true"
                data-bs-toggle="tooltip" data-title="<?php echo e(__('Create New Plan')); ?>"title="<?php echo e(__('Create')); ?>"
                class="btn btn-sm btn-primary btn-icon m-1">
                <i class="ti ti-plus"></i>
            </a>
        </div>
    <?php endif; ?>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('content'); ?>
    <div class="row">
        <?php $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $plan): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <div class="col-lg-4 col-xl-3 col-md-6 col-sm-6">
                <div class="card price-card price-1 wow animate__fadeInUp" data-wow-delay="0.2s"
                    style="
               visibility: visible;
               animation-delay: 0.2s;
               animation-name: fadeInUp;
               ">
                    <div class="card-body <?php echo e(!empty(\Auth::user()->type != 'super admin') ? 'plan-box' : ''); ?>"
                        style="height: 450px;">

                        <span class="price-badge bg-primary"><?php echo e($plan->name); ?></span>
                        <div class="d-flex justify-content-end align-items-center mt-2">
                            <div class="col-9 text-start">
                                <?php if(\Auth::user()->type == 'super admin' && $plan->price > 0): ?>
                                    <div class="form-check form-switch custom-switch-v1">
                                        <input type="checkbox" data-id="<?php echo e($plan->id); ?>"
                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="<?php echo e(__('Enable/Disable')); ?>" class="form-check-input input-primary"
                                        <?php echo e($plan->status == 1 ? 'checked' : ''); ?>>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <?php if(\Auth::user()->type == 'super admin'): ?>
                                <div class="ms-2 action-btn bg-primary">
                                    <a title="Edit Plan" data-size="md" href="#"
                                        class="btn btn-sm d-inline-flex align-items-center text-white"
                                        data-url="<?php echo e(route('plan.edit', $plan->id)); ?>" data-ajax-popup="true"
                                        data-title="<?php echo e(__('Edit Plan')); ?>" data-bs-toggle="tooltip"
                                        data-bs-original-title="<?php echo e(__('Edit')); ?>">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                </div>

                                <?php if($plan->id != 1): ?>
                                    <?php echo Form::open([
                                        'method' => 'DELETE',
                                        'route' => ['plan.destroy', $plan->id],
                                        'id' => 'delete-form-' . $plan->id,
                                    ]); ?>

                                    <div class="ms-2 action-btn bg-primary">
                                        <a href="#!" class="btn btn-sm align-items-center text-white show_confirm"
                                            data-bs-toggle="tooltip" title='Delete'>
                                            <i class="ti ti-trash"></i>
                                        </a>
                                    </div>
                                    <?php echo Form::close(); ?>

                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type == 'owner' && \Auth::user()->plan == $plan->id): ?>
                                <div class="ms-2 d-flex align-items-center">
                                    <i class="f-10 lh-1 fas fa-circle text-success"></i>
                                    <span class="ms-2"><?php echo e(__('Active')); ?></span>
                                </div>
                            <?php endif; ?>
                        </div>

                        <h1 class="mb-4 f-w-600 ">
                            <?php echo e(isset($settings['site_currency_symbol']) ? $settings['site_currency_symbol'] : '$'); ?><?php echo e(number_format($plan->price)); ?><small
                                class="text-sm">/<?php echo e(env('CURRENCY_SYMBOL') . __(\App\Models\Plan::$arrDuration[$plan->duration])); ?></small>

                        </h1>
                        <p class="mb-0">
                            <?php echo e(__('Free Trial Days : ') . __($plan->trial_days ? $plan->trial_days : 0)); ?><br />
                        </p>
                        <p class="my-4"><?php echo e($plan->description); ?></p>

                        <ul class="list-unstyled">
                            <li> <span class="theme-avtar"><i
                                        class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->max_user == -1 ? __('Unlimited') : $plan->max_user); ?>

                                <?php echo e(__('Users')); ?></li>
                            <li><span class="theme-avtar"><i
                                        class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->max_account == -1 ? __('Unlimited') : $plan->max_account); ?>

                                <?php echo e(__('Account')); ?></li>
                            <li><span class="theme-avtar"><i
                                        class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->max_contact == -1 ? __('Unlimited') : $plan->max_contact); ?>

                                <?php echo e(__('Contact')); ?></li>
                            <li class="white-sapce-nowrap"><span class="theme-avtar"><i
                                        class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->storage_limit == -1 ? __('Unlimited') : $plan->storage_limit); ?>

                                <?php echo e(__('MB')); ?> <?php echo e(__('Storage')); ?></li>
                            <li class="white-sapce-nowrap"><span class="theme-avtar"><i
                                        class="text-primary ti ti-circle-plus"></i></span><?php echo e($plan->enable_chatgpt == 'on' ? __('Enable') : __('Disable')); ?>

                                <?php echo e(__('Chat GPT')); ?></li>

                        </ul>
                        <br>

                        <div class="row">
                            <?php if($plan->id != \Auth::user()->plan && $plan->price != 0 && \Auth::user()->type != 'super admin'): ?>
                                <?php if($plan->trial == 1 && empty(\Auth::user()->trial_expire_date) && \Auth::user()->type != 'super admin'): ?>
                                    <a href="<?php echo e(route('plan.trial', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                        class="btn btn-lg btn-primary btn-icon m-1 col-5"><?php echo e(__('Start Free Trial')); ?></a>
                                <?php endif; ?>
                                <a href="<?php echo e(route('plan.payment', \Illuminate\Support\Facades\Crypt::encrypt($plan->id))); ?>"
                                    class="btn btn-lg btn-primary btn-icon m-1 align-items-center col-4"><?php echo e(__('Subscribe')); ?></a>
                            <?php elseif($plan->price <= 0): ?>
                            <?php endif; ?>
                            <?php if(\Auth::user()->type != 'super admin' && \Auth::user()->plan != $plan->id): ?>
                                <?php if($plan->id != 1): ?>
                                    <?php if(\Auth::user()->requested_plan != $plan->id): ?>
                                        <a href="<?php echo e(route('send.request', [\Illuminate\Support\Facades\Crypt::encrypt($plan->id)])); ?>"
                                            class="btn btn-lg btn-primary btn-icon m-1 col-2"
                                            data-title="<?php echo e(__('Send Request')); ?>" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Send Request')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-corner-up-right"></i></span>
                                        </a>
                                    <?php else: ?>
                                        <a href="<?php echo e(route('request.cancel', \Auth::user()->id)); ?>"
                                            class="btn btn-danger btn-icon m-1 col-2"
                                            data-title="<?php echo e(__('Cancle Request')); ?>" data-bs-toggle="tooltip"
                                            title="<?php echo e(__('Cancle Request')); ?>">
                                            <span class="btn-inner--icon"><i class="ti ti-x"></i></span>
                                        </a>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>

                        <?php if(\Auth::user()->type == 'owner' && \Auth::user()->plan == $plan->id): ?>
                            <?php if(empty(\Auth::user()->plan_expire_date) && empty(Auth::user()->trial_expire_date)): ?>
                                <p class="mb-0"><?php echo e(__('Lifetime')); ?></p>
                            <?php elseif(\Auth::user()->plan_expire_date > \Auth::user()->trial_expire_date): ?>
                                <p class="mb-0">
                                    <?php echo e(__('Plan Expires on ')); ?>

                                    <?php echo e(date('d M Y', strtotime(\Auth::user()->plan_expire_date))); ?>

                                </p>
                            <?php else: ?>
                                <p class="mb-0">
                                    <?php echo e(__('Trial Expires on ')); ?>

                                    <?php echo e(!empty(\Auth::user()->trial_expire_date) ? date('d M Y', strtotime(\Auth::user()->trial_expire_date)) : date('Y-m-d')); ?>

                                </p>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startPush('script-page'); ?>
    <script>
        $(document).on('change', '#trial', function() {
            if ($(this).is(':checked')) {
                $('.plan_div').removeClass('d-none');
                $('#trial').attr("required", true);

            } else {
                $('.plan_div').addClass('d-none');
                $('#trial').removeAttr("required");
            }
        });

        $('.input-primary').on('change', function() {
            var planId = $(this).data('id');
            var isChecked = $(this).prop('checked');

            $.ajax({
                type: 'POST',
                url: '<?php echo e(route('update.plan.status')); ?>',
                data: {
                    '_token': '<?php echo e(csrf_token()); ?>',
                    'plan_id': planId
                },
                success: function(response) {
                    show_toastr('Error', response.message, 'error')

                },
                error: function(error) {

                    if (error.status === 404) {
                        $(this).prop('checked', !isChecked);
                    }
                }
            });
        });
    </script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.admin', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /var/www/html/resources/views/plan/index.blade.php ENDPATH**/ ?>