<?php
$this->breadcrumbs=array(
	'交易记录',
);

$this->menu=array(
	array('label'=>'我的帐户', 'url'=>array('user/panel'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'翻译记录', 'url'=>array('user/translateResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'交易记录', 'url'=>array('user/chargeResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	array('label'=>'联系方式', 'url'=>array('user/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('member')),
);?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'charge-grid',
	'dataProvider'=>$model->search(),
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '第{start}～第{end}个，共{count}个订单',
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
			'value'=>'Lookup::item("RechargeWays",$data->recharge_way)',
            'filter'=>false,
		),
		/*
		'user_id',
		*/
	),
)); ?>
