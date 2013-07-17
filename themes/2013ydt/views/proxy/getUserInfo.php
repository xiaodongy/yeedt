<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 完善资料';
$this->breadcrumbs=array(
	'完善资料',
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
    	array('label'=>'个人中心', 'url'=>array('proxy/panel'), 'visible'=>Yii::app()->user->checkAccess('agents')),
		 array('label'=>'客户管理', 'url'=>array('proxy/referral'), 'visible'=>Yii::app()->user->checkAccess('agents')),
	    //array('label'=>'收益管理', 'url'=>array('proxy/revenue'), 'visible'=>Yii::app()->user->checkAccess('agents')),
	    array('label'=>'完善资料', 'url'=>array('proxy/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('agents')),
    ),
)); ?>

<div class="form">
    <div class="account-content user-contact">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'user-center-getUserInfo-form',
	'enableAjaxValidation'=>false,
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

<?php echo $form->labelEx($model,'real_name',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'real_name'); ?>
    <?php echo str_replace("div","i",$form->error($model,'real_name',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'identity_card_number',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'identity_card_number'); ?>
    <?php echo str_replace("div","i",$form->error($model,'identity_card_number',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'bank_type',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    <?php echo $form->dropDownList($model,'bank_type', Lookup::items('BanksType'), array('prompt'=>'请选择银行类型',"class"=>"flog-js")); ?>
    <?php echo str_replace("div","i",$form->error($model,'bank_type',array("class"=>"demand-error-message","style"=>"margin-left: 65px;"))); ?>
</div>

<?php echo $form->labelEx($model,'bank_number',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'bank_number'); ?>
    <?php echo str_replace("div","i",$form->error($model,'bank_number',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo $form->labelEx($model,'recipient_address',array("for"=>"userNameI")); ?>
<div class="form-item-layout">
    <?php echo $form->textField($model,'recipient_address',array('style'=>"width: 380px;")); ?>
    <?php echo str_replace("div","i",$form->error($model,'recipient_address',array("class"=>"demand-error-message"))); ?>
</div>

<?php echo CHtml::button('提交', array('submit' => array('proxy/getUserInfo'),"class"=>"clog-js control-btn")); ?>
<?php $this->endWidget(); ?>
                            </div><!-- form -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
