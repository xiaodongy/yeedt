<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'htmlOptions' => array('class' => 'user-info'),
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<span class="title">
    <i class="important">*</i> 为必填项
</span>

<?php echo $form->labelEx($model,'name',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->textField($model,'name'); ?>
    <?php echo str_replace("div","i",$form->error($model,'name',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'email',array("for"=>"userEmailI")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->textField($model,'email'); ?>
    <?php echo str_replace("div","i",$form->error($model,'email',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'phone',array("for"=>"userPhoneI")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->textField($model,'phone'); ?>
    <?php echo str_replace("div","i",$form->error($model,'phone',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'qq',array("for"=>"userQQI")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->textField($model,'qq'); ?>
    <?php echo str_replace("div","i",$form->error($model,'qq',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'roles',array("for"=>"roles")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->dropDownList($model, 'roles', Lookup::items('UserRoles')); ?>
    <?php echo str_replace("div","i",$form->error($model,'roles',array("class"=>"demand-error-message"))); ?>
</div>

<?php if ('agents' === $model->roles): ?>
<?php echo $form->labelEx($model,'rebate_ratio',array("for"=>"userQQI")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->textField($model,'rebate_ratio'); ?>
    <?php echo str_replace("div","i",$form->error($model,'rebate_ratio',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'sharing_ratio',array("for"=>"userQQI")); ?>
<div class="form-item-layout">
    &nbsp;:&nbsp;<?php echo $form->textField($model,'sharing_ratio'); ?>
    <?php echo str_replace("div","i",$form->error($model,'sharing_ratio',array("class"=>"demand-error-message"))); ?>
</div>

<?php endif; ?>

<?php echo CHtml::submitButton('保存信息',array("class"=>"clog-js control-btn")); ?>

<?php $this->endWidget(); ?>
</div><!-- form -->
