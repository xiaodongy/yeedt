<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 我的帐户';
$this->breadcrumbs=array(
	$user->name,
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
                        <div class="account-content my-account">
<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

                            <p><b><?php echo CHtml::encode(Lookup::item("UserRoles",$user->roles)); ?></b>：<i><?php echo CHtml::encode($user->email); ?></i>，欢迎您！</p>
                            <p>当前账户余额：<i class="large"><?php echo $user->balance; ?></i>元
                                <?php echo CHtml::link('充值', array('user/charge', 'source'=>'account'), array('target'=>'_blank',"class"=>"control-btn")); ?>
                            </p>
                            <p>其中体验金为：<i class="large"><?php echo $user->experience; ?></i>元</p>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
