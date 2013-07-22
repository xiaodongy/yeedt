<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 文档订单';
$this->breadcrumbs=array(
	'文档翻译订单',
);
?>

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

<div class="account-content trans-accord">

<?php
$this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translate-grid',
	'dataProvider'=>$model->search(),
    //'template' => '{items}{summary}',
    //'selectableRows'=>1,
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '第{start}～第{end}个，共{count}个订单',
    'itemsCssClass' => 'accord-table',
    'pager'=>array(
        'header' => false,
        //'cssFile'=>Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'class'=>'CLinkPager',
        'firstPageLabel' => '首页',
        'prevPageLabel'  => '<<上一页',
        'nextPageLabel'  => '下一页>>',
        'lastPageLabel'  => '末页',
         'maxButtonCount' => 5,          //最大按钮数
    ),
	'filter'=>$model,
	'columns'=>array(
        array(
            'name'=>'id',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode($data->id), array("user/orderResult","orderId"=>$data->id),array("target"=>"_blank"))',
        ),
		array(
			'name'=>'language',
			'value'=>'Lookup::item("FileTranslateLanguages",$data->language)',
            'filter'=>false,
		),
        array(
            'header'=>'翻译文档',
            'type'=>'raw',
            'value'=>'CHtml::encode($data->document) . "&nbsp;&nbsp;" . CHtml::link("下载原文", array("user/download","orderId"=>$data->id),array("target"=>"_blank"))',
            'filter'=>false,
            'htmlOptions'=>array('class'=>'main-content'),
        ),
        array(
            'name'=>'word_count',
            'value'=>'CHtml::encode($data->word_count)',
            'filter'=>false,
        ),
        array(
            'name'=>'price',
            'value'=>'CHtml::encode($data->price . "元")',
            'filter'=>false,
        ),
		array(
			'name'=>'status',
            'type'=>'raw',
			'value'=>'Lookup::item("OrderStatus",$data->status) . (("new" == $data->status and "file" == $data->type and 0 == $data->word_count and 0 == $data->price) ? "：正在估算订单价格" : "")',
			'filter'=>Lookup::items('OrderStatus'),
		),
        array(
            'header'=>'操作',
            'type'=>'raw',
            'value'=>'CHtml::link("确认订单", array("user/checkRates","orderId"=>$data->id),array("target"=>"_blank")) . "<br />" . (("invalid" == $data->status || "new" == $data->status) ? "" : CHtml::link("上传译文",array("user/uploadDocument","orderId"=>$data->id),array("target"=>"_blank")))',
            'filter'=>false,
        ),
        array(
            'name'=>'create_time',
            'type'=>'raw',
            'value'=>'date("Y-m-d", $data->create_time) . "<br />" . date("H:i:s", $data->create_time)',
            'filter'=>false,
        ),
	),
));
?>

                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
