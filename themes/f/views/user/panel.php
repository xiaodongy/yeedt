<?php
$this->breadcrumbs=array(
	$user->name,
);

$this->menu=array(
	array('label'=>'我的帐户', 'url'=>array('user/panel'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'翻译记录', 'url'=>array('user/translateResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'交易记录', 'url'=>array('user/chargeResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'联系方式', 'url'=>array('user/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('member')),
);?>

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

<div class="account-content my-account">
    <p><?php echo Lookup::item("UserRoles",$user->roles); ?>：<i><?php echo $user->email; ?></i>，欢迎您！</p>

    <p>当前账户余额：<i class="large"><?php echo $user->balance; ?></i> 元
    <?php echo CHtml::link('充值', array('user/charge', 'source'=>'account'), array('target'=>'_blank')); ?>
    <p>其中体验金为：<i class="large"><?php echo $user->experience; ?></i> 元</p>
</div>
