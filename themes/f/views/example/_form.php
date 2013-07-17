<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'example-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note">（<span class="required">*</span>为必填）</p>

	<div class="row">
		<?php echo $form->labelEx($model,'title'); ?>：
		<?php echo $form->textField($model,'title'); ?>
		<?php echo $form->error($model,'title'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'code'); ?>：
		<?php echo $form->textField($model,'code'); ?>
		<?php echo $form->error($model,'code'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original'); ?>：
		<?php echo $form->error($model,'original'); ?>
        <?php $this->widget('application.extensions.cleditor.ECLEditor', array(
            'model'=>$model,
            'attribute'=>'original',
            'options'=>array(
               'width'=>'600',
                'height'=>250,
                'useCSS'=>true,
            ),
        //'value'=>$model->original,
        )); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translation'); ?>：
		<?php echo $form->error($model,'translation'); ?>
        <?php $this->widget('application.extensions.cleditor.ECLEditor', array(
            'model'=>$model,
            'attribute'=>'translation',
            'options'=>array(
               'width'=>'600',
                'height'=>250,
                'useCSS'=>true,
            ),
        //'value'=>$model->translation,
        )); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'position'); ?>：
		<?php echo $form->textField($model,'position',array('size'=>'3')); ?>
		<?php echo $form->error($model,'position'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
