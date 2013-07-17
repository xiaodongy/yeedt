<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note">（<span class="required">*</span>为必填）</p>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>：
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>
	
<?php if('create' == Yii::app()->getController()->getAction()->id): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
		<?php echo $form->passwordField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>
<?php else: ?>
		<?php echo $form->hiddenField($model,'password'); ?>
<?php endif; ?>	

<!--
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receive_email'); ?>
		<?php echo $form->textField($model,'receive_email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'receive_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>
-->
	<div class="row">
		<?php echo $form->labelEx($model,'roles'); ?>：&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <?php echo $form->dropDownList($model, 'roles', Lookup::items('UserRoles')); ?>
		<?php echo $form->error($model,'roles'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建帐号' : '保存信息'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
