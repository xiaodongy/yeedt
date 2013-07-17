<h3>账户充值</h3>
<p>当前余额：<?php echo User::model()->findByPk(Yii::app()->user->id)->balance; ?> 元</p>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'charge-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'money'); ?>：
		<?php echo $form->textField($model,'money'); ?> 元
		<?php echo $form->error($model,'money'); ?>
    </div>

	<div class="row">
        <?php echo $form->labelEx($model,'recharge_way'); ?>：
		<?php echo $form->error($model,'recharge_way'); ?>
        <h5>1. 支付宝</h5>
        <?php echo $form->radioButtonList($model,'recharge_way',Lookup::radioItems("RechargeWays", "alipay")); ?>
        <hr />
<!--
        <h5>2. 网银支付</h5>
        <?php echo $form->radioButtonList($model,'recharge_way',Lookup::radioItems("InternetBanking"),array('separator'=>'&nbsp;&nbsp;','template' => '{input} {label}')); ?>
        <hr />
-->
    </div>

    <h5>2. 线下银行汇款，请<?php echo CHtml::link(CHtml::encode('点击'), array('path/about#fromBank'), array('target'=>'_blank')); ?>这里查看详情。</h5>

	<?php if(CCaptcha::checkRequirements()): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'verifyCode'); ?><span class="required">*</span>
		<div>
		<?php $this->widget('CCaptcha', array('clickableImage'=>true, 'showRefreshButton'=>true)); ?>
		<?php echo $form->textField($model,'verifyCode',array("title"=>"点击图片刷新验证码")); ?>
		</div>
		<div class="hint">请输入上图所示的字母。<i>大小写不敏感</i>
		<?php echo $form->error($model,'verifyCode'); ?></div>
	</div>
	<?php endif; ?>

	<div class="row buttons">
		<?php echo CHtml::submitButton('充值'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->
