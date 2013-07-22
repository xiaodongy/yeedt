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
    'activeCssClass'=>'current clog-js',
    'items'=>array(
    	array('label'=>'快译订单', 'url'=>array('user/orderFast'),'visible'=>(Yii::app()->user->checkAccess('operator') || Yii::app()->user->checkAccess('interpreter'))),
    	array('label'=>'文档订单', 'url'=>array('user/orderFile'), 'visible'=>(Yii::app()->user->checkAccess('operator') || Yii::app()->user->checkAccess('interpreter'))),
        array('label'=>'客户反馈', 'url'=>array('user/orderComments'), 'visible'=>(Yii::app()->user->checkAccess('operator') || Yii::app()->user->checkAccess('interpreter'))),
    	array('label'=>'交易查询', 'url'=>array('user/chargeAdmin'), 'visible'=>(Yii::app()->user->checkAccess('operator') || Yii::app()->user->checkAccess('interpreter'))),
    ),
)); ?>

                        <div class="account-content deal-accord">
 <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'charge-grid',
	'dataProvider'=>$model->search(),
    //'ajaxUpdate' => false,
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '第{start}～第{end}个，共{count}个记录',
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
        array(
            'name' => 'user',
            'type' => 'raw',
            'value' => '!empty($data->user) ? CHtml::link(CHtml::encode($data->user->email), array("user/view", "id" => $data->user->id), array("target" => "_blank")) : CHtml::mailto(CHtml::encode($data->user_email), $data->user_email, array("title" => "点击发送邮件")) . "（<font color=\"red\">未注册</font>）"',
        ),
	),
)); ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
