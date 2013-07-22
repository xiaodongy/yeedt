<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 会员信息';
$this->breadcrumbs=array(
    '账户详细信息',
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
		array('label'=>'会员信息', 'url'=>array('user/view', 'id'=>$model->id)),
    	array('label'=>'用户管理', 'url'=>array('user/admin')),
	    array('label'=>'修改', 'url'=>array('user/update', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('user/delete','id'=>$model->id),'confirm'=>'你确定要删除此帐号么，记录删除后将无法找回')),
	),
)); ?>

    <div class="account-content user-contact">

<h1>帐号ID #<?php echo $model->id; ?></h1>

<style>
table.detail-view {font-size: 1.3em;}
</style>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'roles',
            'value'=>CHtml::encode(Lookup::item('UserRoles', $model->roles)),
        ),
		//'id',
		array(
			'name' => 'email',
			'type' => 'raw',
			'value'=>CHtml::mailto(CHtml::encode($model->email),$model->email,array("title"=>"发送邮件给：" . $model->name)),
		),
        array(
            'name' => 'balance',
            'value' => CHtml::encode(number_format($model->balance, 2)) . " 元",
        ),
        array(
            'label' => "消费总额",
            'value' => CHtml::encode(number_format($model->chargeSum, 2)) . " 元",
        ),
		//'password',
		'name',
		'phone',
		array(
			'name' => 'receive_email',
			'type' => 'raw',
			'value'=>CHtml::mailto(CHtml::encode($model->receive_email),$model->receive_email,array("title"=>"发送邮件给：" . $model->receive_email)),
		),
		'qq',
        /*
		array(
			'name' => 'user_center.real_name',
			'value'=>CHtml::encode($model->user_center["real_name"]),
        ),
		array(
			'name' => 'user_center.identity_card_number',
			'value'=>CHtml::encode($model->user_center["identity_card_number"]),
        ),
		array(
			'name' => 'user_center.recipient_address',
			'value'=>CHtml::encode($model->user_center["recipient_address"]),
        ),
		array(
			'name' => 'user_center.bank_type',
			'value'=>CHtml::encode($model->user_center["bank_type"]),
        ),
		array(
			'name' => 'user_center.bank_number',
			'value'=>CHtml::encode($model->user_center["bank_number"]),
        ),
		array(
			'name' => 'user_center.partner',
			'value'=>CHtml::encode($model->user_center["partner"]),
        ),
		array(
			'name' => 'user_center.key',
			'value'=>CHtml::encode($model->user_center["key"]),
        ),
		array(
			'name' => 'user_center.rebate_ratio',
			'value'=>CHtml::encode($model->user_center["rebate_ratio"]),
        ),
		array(
			'name' => 'user_center.sharing_ratio',
			'value'=>CHtml::encode($model->user_center["sharing_ratio"]),
		),
         */
		array(
			'name' => 'join_date',
			'value'=>CHtml::encode(date("Y-m-d H:i:s", $model->join_date)),
		),
		array(
			'name' => 'ip',
			'type' => 'raw',
			'value'=>CHtml::encode($model->ip) . "&nbsp;&nbsp;<i>[" . $model->ip_attribution . "]</i>",
		),
	),
)); ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
