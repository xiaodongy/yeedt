<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'upload-document-uploadDocument-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

	<p class="note">（<span class="required">*</span>为必填）</p>

	<div class="row">
		<?php echo $form->labelEx($model,'id'); ?>：
		<?php echo CHtml::link(CHtml::encode($model->id), array("user/orderResult","orderId"=>$model->id),array("target"=>"_blank")) ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>：
		<?php echo CHtml::link(CHtml::encode($model->name), array("user/view","id"=>$model->user_id),array("target"=>"_blank")); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>：
		<?php echo $model->phone; ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>：
		<?php echo CHtml::mailto(CHtml::encode($model->email),$model->email,array("title"=>"发送邮件给：" . $model->name)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>：
		<?php echo CHtml::encode(Lookup::item('TranslateLanguages',$model->language)); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?>：
		<?php echo CHtml::encode($model->document) . "&nbsp;&nbsp;" . CHtml::link("下载原文", array("user/download","orderId"=>$model->id),array("target"=>"_blank")); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'demand'); ?>：
		<div style="margin-left: 10px;"><?php echo nl2br($model->demand); ?></div>
		<hr />
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'t_document'); ?><span class="required">*</span>：
		<?php echo $form->fileField($model,'t_document'); ?>
		<?php echo $form->error($model,'t_document', array('class'=>'error-document')); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('提交译文文档'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->