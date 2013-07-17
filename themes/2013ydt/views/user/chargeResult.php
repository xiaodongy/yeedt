<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 交易记录';
$this->breadcrumbs=array(
	'交易记录',
);?>

    <div id="bd" class="account">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content result-list">
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
                        <div class="account-content deal-accord">
                        	<!--
                        	<div class="accord-nav">
								<a href="" class="current" data-act="chongzhi-record">充值记录</a>
                                <a href="account03.html" class="clog-js" data-act="koufei-record">扣费记录</a>
							</div>
							-->
 <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'charge-grid',
	'dataProvider'=>$model->search(),
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '',
    'itemsCssClass' => 'accord-table',
    'pager'=>array(
        'header'         => false,
        //'cssFile'=>Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        //'class'=>'CLinkPager',
        'firstPageLabel' => '首页',
        'prevPageLabel'  => '<<上一页',
        'nextPageLabel'  => '下一页>>',
        'lastPageLabel'  => '末页',
         'maxButtonCount' => 5,          //最大按钮数
    ),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name'=>'chargetype',
			'value'=>'Lookup::item("ChargeTypes",$data->chargetype)',
			'filter'=>Lookup::items('ChargeTypes'),
		),
        array(
            'name'=>'translate_id',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->translate_id),array("user/orderResult", "orderId"=>$data->translate_id),array("target"=>"_blank"))',
        ),
        array(
            'name'=>'money',
            'value'=>'CHtml::encode($data->money . "元")',
            'filter'=>false,
        ),
        array(
            'name'=>'charge_time',
            'type'=>'raw',
            'value'=>'date("Y-m-d H:i:s", $data->charge_time)',
            'filter'=>false,
        ),
		array(
			'name'=>'recharge_way',
			'value'=>'Lookup::item("BanksType",$data->recharge_way)',
            'filter'=>false,
		),
		/*
		'user_id',
		*/
	),
)); ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
