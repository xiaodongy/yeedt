<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 个人中心';
$this->breadcrumbs=array(
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
                        <div class="account-content my-account">
<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

                            <p><b><?php echo CHtml::encode(Lookup::item("UserRoles",$user->roles)); ?></b>：<i><?php echo CHtml::encode($user->email); ?></i>，欢迎您！</p>
                            <p>返点比率：<i class="large"><?php echo $user->user_center['rebate_ratio'] ? $user->user_center['rebate_ratio'] : 5; ?></i>%
                                <?php echo CHtml::link('提现', array('proxy/withdrawals'), array('target'=>'_blank',"class"=>"control-btn")); ?>
                            </p>
                            <p>分成比率：<i class="large"><?php echo $user->user_center['sharing_ratio'] ? $user->user_center['sharing_ratio'] : 5; ?></i>%</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
