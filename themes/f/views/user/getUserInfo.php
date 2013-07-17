<?php $this->menu=array(
	array('label'=>'我的帐户', 'url'=>array('user/panel'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'翻译记录', 'url'=>array('user/translateResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'交易记录', 'url'=>array('user/chargeResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'联系方式', 'url'=>array('user/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('member')),
);?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'get-user-info-form-getUserInfo-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?php
$this->widget('ext.EUserFlash',array(
            'initScript'=>"$('.userflash_success').fadeOut(3000);$('.userflash_notice').fadeOut(3000);"));
?>

	<p class="note">（<span class="required">*</span>为必填）</p>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>：
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>：
		<?php echo $form->textField($model,'phone'); ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'receive_email'); ?>：
		<?php echo $form->textField($model,'receive_email'); ?>
		<?php echo $form->error($model,'receive_email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>&nbsp;&nbsp;：
		<?php echo $form->textField($model,'qq'); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>


	<div class="row buttons">
        <?php echo CHtml::submitButton('提交'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
