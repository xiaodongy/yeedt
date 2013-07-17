<?php
/* @var $this ForgetPasswordController */
/* @var $model ForgetPassword */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forget-password-forgetPassword-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'password'); ?>
		<?php echo $form->textField($model,'password'); ?>
		<?php echo $form->error($model,'password'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'roles'); ?>
		<?php echo $form->textField($model,'roles'); ?>
		<?php echo $form->error($model,'roles'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'join_date'); ?>
		<?php echo $form->textField($model,'join_date'); ?>
		<?php echo $form->error($model,'join_date'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_verify'); ?>
		<?php echo $form->textField($model,'is_verify'); ?>
		<?php echo $form->error($model,'is_verify'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receive_email'); ?>
		<?php echo $form->textField($model,'receive_email'); ?>
		<?php echo $form->error($model,'receive_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip_attribution'); ?>
		<?php echo $form->textField($model,'ip_attribution'); ?>
		<?php echo $form->error($model,'ip_attribution'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq'); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ip'); ?>
		<?php echo $form->textField($model,'ip'); ?>
		<?php echo $form->error($model,'ip'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'balance'); ?>
		<?php echo $form->textField($model,'balance'); ?>
		<?php echo $form->error($model,'balance'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'experience'); ?>
		<?php echo $form->textField($model,'experience'); ?>
		<?php echo $form->error($model,'experience'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'consumer_state'); ?>
		<?php echo $form->textField($model,'consumer_state'); ?>
		<?php echo $form->error($model,'consumer_state'); ?>
	</div>


	<div class="row buttons">
		<?php echo CHtml::submitButton('Submit'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->