<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 联系方式';
$this->breadcrumbs=array(
	'联系方式',
);
?>

    <div id="bd" class="account">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
<?php $this->widget('zii.widgets.CMenu',array(
    'id'=>'category',
    'htmlOptions'=>array('class'=>'account-nav'),
    'activeCssClass'=>'current',
    'items'=>array(
    	array('label'=>'我的帐户', 'url'=>array('user/panel'), 'visible'=>Yii::app()->user->checkAccess('member')),
	
	    array('label'=>'翻译记录', 'url'=>array('user/translateResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'交易记录', 'url'=>array('user/chargeResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'联系方式', 'url'=>array('user/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('member')),
		array('label'=>'我的邀请', 'url'=>array('user/referral'), 'visible'=>Yii::app()->user->checkAccess('member')),
    ),
)); ?>

<div class="form">
    <div class="account-content user-contact">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'get-user-info-form-getUserInfo-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'htmlOptions' => array('class' => 'user-info'),
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<?php
$this->widget('ext.EUserFlash',array(
            'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"));
?>

<span class="title">
    <i class="important">*</i> 为必填项
</span>

<?php echo $form->labelEx($model,'name',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'name'); ?>
    <?php echo str_replace("div","i",$form->error($model,'name',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'phone',array("for"=>"userPhoneI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'phone'); ?>
    <?php echo str_replace("div","i",$form->error($model,'phone',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'receive_email',array("for"=>"userEmailI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'receive_email'); ?>
    <?php echo str_replace("div","i",$form->error($model,'receive_email',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'qq',array("for"=>"userQQI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'qq'); ?>
    <?php echo str_replace("div","i",$form->error($model,'qq',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo CHtml::button('提交', array('submit' => array('user/getUserInfo'),"class"=>"clog-js control-btn")); ?>
                            <?php $this->endWidget(); ?>
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
