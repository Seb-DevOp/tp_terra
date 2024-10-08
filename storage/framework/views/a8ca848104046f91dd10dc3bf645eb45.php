<?php
$settings = App\Models\Utility::settings();
?>
<?php echo e(Form::model($plan, array('route' => array('plan.update', $plan->id), 'method' => 'PUT', 'enctype' => "multipart/form-data"))); ?>

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
        <?php echo e(Form::label('name',__('Name'),['class'=>'form-label'])); ?>

        <?php echo e(Form::text('name',null,array('class'=>'form-control font-style','placeholder'=>__('Enter Plan Name'),'required'=>'required'))); ?>

    </div>
    </div>
    <?php if($plan->price>0): ?>
    <div class="col-6">
        <div class="form-group">
            <?php echo e(Form::label('price',__('Price'),['class'=>'form-label'])); ?>

            <?php echo e(Form::number('price',null,array('class'=>'form-control','placeholder'=>__('Enter Plan Price'),'step'=>'0.01'))); ?>

        </div>
    </div>
    <?php endif; ?>
    <div class="col-6">
    <div class="form-group">
        <?php echo e(Form::label('max_user',__('Maximum User'),['class'=>'form-label'])); ?>

        <?php echo e(Form::number('max_user',null,array('class'=>'form-control','required'=>'required'))); ?>

        <span class="small"><?php echo e(__('Note: "-1" for lifetime')); ?></span>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
        <?php echo e(Form::label('max_account',__('Maximum Account'),['class'=>'form-label'])); ?>

        <?php echo e(Form::number('max_account',null,array('class'=>'form-control','required'=>'required'))); ?>

        <span class="small"><?php echo e(__('Note: "-1" for lifetime')); ?></span>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
        <?php echo e(Form::label('max_contact',__('Maximum Contact'),['class'=>'form-label'])); ?>

        <?php echo e(Form::number('max_contact',null,array('class'=>'form-control','required'=>'required'))); ?>

        <span class="small"><?php echo e(__('Note: "-1" for lifetime')); ?></span>
    </div>
    </div>
    <div class="col-6">
    <div class="form-group">
        <?php echo e(Form::label('duration', __('Duration'),['class'=>'form-label'])); ?>

        <?php echo Form::select('duration', $arrDuration, null,array('class' => 'form-control','required'=>'required')); ?>

    </div>
    </div>
    <div class="col-12">
        <div class="form-group">
            <?php echo e(Form::label('storage_limit', __('Storage Limit'), ['class' => 'form-label'])); ?>

            <div class="input-group">
                <input for="storage_limit" name="storage_limit" type="text" class="form-control" value=<?php echo e($plan->storage_limit); ?>

                    required>
                <div class="input-group-append">
                    <span class="input-group-text">
                        MB
                    </span>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-6 mt-3 plan_price_div">
        <label class="form-check-label" for="trial"></label>
        <div class="form-group">
            <label for="trial" class="form-label"><?php echo e(__('Trial is enable(on/off)')); ?></label>
            <div class="form-check form-switch custom-switch-v1 float-end">
                <input type="checkbox" name="trial" class="form-check-input input-primary pointer" value="1" id="trial" <?php echo e($plan->trial == 1 ?' checked ':''); ?>>
                <label class="form-check-label" for="trial"></label>
            </div>
        </div>
    </div>
    <div class="col-md-6  <?php echo e($plan->trial == 1 ?'  ':'d-none'); ?> plan_div plan_price_div">
        <div class="form-group">
            <?php echo e(Form::label('trial_days', __('Trial Days'), ['class' => 'form-label'])); ?>

            <?php echo e(Form::number('trial_days',null, ['class' => 'form-control','placeholder' => __('Enter Trial days'),'step' => '1','min'=>'1'])); ?>

        </div>
    </div>
    <div class="col-12">
    <div class="form-group">
        <?php echo e(Form::label('description', __('Description'),['class'=>'form-label'])); ?>

        <?php echo Form::textarea('description', null, ['class'=>'form-control','rows'=>'2']); ?>

    </div>
    </div>
    <div class="col-6">
        <div class="custom-control form-switch pt-2">
            <input type="checkbox" class="form-check-input" name="enable_chatgpt" id="enable_chatgpt"
            <?php echo e($plan->enable_chatgpt == 'on' ? 'checked="checked"' : ''); ?>>
        <label class="custom-control-label form-check-label"
            for="enable_chatgpt"><?php echo e(__('Enable Chatgpt')); ?></label>
        </div>
    </div>

    <div class="modal-footer">
        <button type="button" class="btn  btn-light"
            data-bs-dismiss="modal">Close</button>
            <?php echo e(Form::submit(__('Update'),array('class'=>'btn btn-primary '))); ?>

    </div>
</div>
<?php echo e(Form::close()); ?>



<?php /**PATH /var/www/html/resources/views/plan/edit.blade.php ENDPATH**/ ?>