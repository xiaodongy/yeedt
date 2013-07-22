<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'translate-form',
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>
		<?php echo $form->textField($model,'language',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original'); ?>
		<?php echo $form->textArea($model,'original',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'original'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->textField($model,'document',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'document'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'upload_file_name'); ?>
		<?php echo $form->textField($model,'upload_file_name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'upload_file_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'word_count'); ?>
		<?php echo $form->textField($model,'word_count'); ?>
		<?php echo $form->error($model,'word_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price',array('size'=>60,'maxlength'=>64)); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'demand'); ?>
		<?php echo $form->textArea($model,'demand',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'demand'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>
		<?php echo $form->textField($model,'phone',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq',array('size'=>32,'maxlength'=>32)); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_invoice'); ?>
		<?php echo $form->textField($model,'is_invoice'); ?>
		<?php echo $form->error($model,'is_invoice'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>128)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textArea($model,'translation',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'translation'); ?>
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