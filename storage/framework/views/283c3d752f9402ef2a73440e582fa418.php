<?php
$settings = App\Models\Utility::settings();
?>
<?php echo e(Form::open(['url' => 'plan', 'enctype' => 'multipart/form-data'])); ?>

<div class="row">
    <?php if(!empty($settings['chatgpt_key'])): ?>
    <div class="text-end">
        <a href="#" data-size="md" class="btn btn-sm btn-primary" data-ajax-popup-over="true" data-size="md"
            data-title="<?php echo e(__('Generate content with AI')); ?>" data-url="<?php echo e(route('generate', ['plan'])); ?>"
            data-toggle="tooltip" title="<?php echo e(__('Generate')); ?>">
            <i class="fas fa-robot"></span><span class="robot"><?php echo e(__('Generate With AI')); ?></span></i>
        </a>
    </div>
    <?php endif; ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('name', __('Name'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::text('name', null, ['class' => 'form-control font-style', 'placeholder' => __('Enter Plan Name'), 'required' => 'required'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group ">
            <?php echo e(Form::label('price', __('Price'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('price', null, ['class' => 'form-control', 'placeholder' => __('Enter Plan Price'), 'step' => '0.01'])); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="form-group ">
            <?php echo e(Form::label('max_user', __('Maximum User'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('max_user', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Plan Price')])); ?>

            <span class="small"><b><?php echo e(__('Note: "-1" for Unlimited')); ?></b></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group ">
            <?php echo e(Form::label('max_account', __('Maximum Account'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('max_account', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Maximum Account')])); ?>

            <span class="small"><b><?php echo e(__('Note: "-1" for Unlimited')); ?></b></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('max_contact', __('Maximum Contact'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('max_contact', null, ['class' => 'form-control', 'required' => 'required', 'placeholder' => __('Enter Maximum Contact')])); ?>

            <span class="small"><b><?php echo e(__('Note: "-1" for Unlimited')); ?></b></span>
        </div>
    </div>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('duration', __('Duration'), ['class' => 'form-label'])); ?>

            <?php echo Form::select('duration', $arrDuration, null, [
                'class' => 'form-control',
                'required' => 'required',
                'placeholder' => __('Enter Duration'),
            ]); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('storage_limit', __('Storage Limit'), ['class' => 'form-label'])); ?>

            <div class="input-group">
                <input for="storage_limit" name="storage_limit" type="text" class="form-control" value=""
                    required>
                <div class="input-group-append">
                    <span class="input-group-text">
                        MB
                    </span>
                </div>
            </div>
            <small>Note : upload size (In MB)</small>

        </div>
    </div>
    <div class="col-md-6 mt-3 plan_price_div">
        <label class="form-check-label" for="trial"></label>
        <div class="form-group">
            <label for="trial" class="form-label"><?php echo e(__('Trial is enable(on/off)')); ?></label>
            <div class="form-check form-switch custom-switch-v1 float-end">
                <input type="checkbox" name="trial" class="form-check-input input-primary pointer" value="1" id="trial" >
                <label class="form-check-label" for="trial"></label>
            </div>
        </div>
    </div>
    <div class="col-md-6 d-none plan_div plan_price_div">
        <div class="form-group">
            <?php echo e(Form::label('trial_days', __('Trial Days'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('trial_days',null, ['class' => 'form-control','placeholder' => __('Enter Trial days'),'step' => '1','min'=>'1','oninput' => 'this.value = Math.max(1, this.value);'])); ?>

        </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('description', __('Description'))); ?>

            <?php echo Form::textarea('description', null, [
                'class' => 'form-control',
                'rows' => '2',
                'placeholder' => __('Enter Description'),
            ]); ?>

        </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="enable_chatgpt" id="enable_chatgpt">
            <label class="custom-control-label form-check-label"
                for="enable_chatgpt"><?php echo e(__('Enable Chatgpt')); ?></label>
        </div>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn  btn-light" data-bs-dismiss="modal"><?php echo e(__('Close')); ?></button>
        <?php echo e(Form::submit(__('Create'), ['class' => 'btn btn-primary '])); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>

<?php /**PATH /var/www/html/resources/views/plan/create.blade.php ENDPATH**/ ?>