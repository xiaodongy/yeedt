<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'charge-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'chargetype'); ?>
		<?php echo $form->textField($model,'chargetype',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'chargetype'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'money'); ?>
		<?php echo $form->textField($model,'money',array('size'=>16,'maxlength'=>16)); ?>
		<?php echo $form->error($model,'money'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'charge_time'); ?>
		<?php echo $form->textField($model,'charge_time'); ?>
		<?php echo $form->error($model,'charge_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'recharge_way'); ?>
		<?php echo $form->textField($model,'recharge_way',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'recharge_way'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translate_id'); ?>
		<?php echo $form->textField($model,'translate_id'); ?>
		<?php echo $form->error($model,'translate_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->