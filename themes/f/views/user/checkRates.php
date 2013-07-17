<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'check-rates-checkRates-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(3000);$('.userflash_notice').fadeOut(3000);"
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
		<?php echo $form->labelEx($model,'word_count'); ?>：
		<?php echo $form->textField($model,'word_count'); ?>
		<?php echo $form->error($model,'word_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>：
		<?php echo $form->textField($model,'price'); ?> 元
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>：
        <?php echo $form->dropDownList($model, 'status', Lookup::items('OrderStatus')); ?>
		<?php echo $form->error($model,'status'); ?>
    </div>

	<div class="row buttons">
		<?php echo CHtml::submitButton('确认信息'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->