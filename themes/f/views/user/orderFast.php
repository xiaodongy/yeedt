<?php
$this->breadcrumbs=array(
	'快速翻译订单',
);

$this->menu=array(
	array('label'=>'文档订单', 'url'=>array('user/orderFile'), 'visible'=>(Yii::app()->user->checkAccess('operator') || Yii::app()->user->checkAccess('interpreter'))),
);?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translate-grid',
	'dataProvider'=>$model->search(),
    //'template' => '{items}{summary}',
    //'selectableRows'=>1,
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '第{start}～第{end}个，共{count}个订单',
    'pager'=>array(
        'header' => false,
        'cssFile'=>Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        'class'=>'CLinkPager',
        'firstPageLabel' => '首页',
        'prevPageLabel'  => '<<上一页',
        'nextPageLabel'  => '下一页>>',
        'lastPageLabel'  => '末页',
         'maxButtonCount' => 3,          //最大按钮数
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
			'value'=>'Lookup::item("TranslateLanguages",$data->language)',
            'filter'=>false,
		),
        array(
            'header'=>'翻译内容',
            'type'=>'raw',
            'value'=>'CHtml::link(CHtml::encode(mb_substr(strip_tags($data->original), 0, 20, "utf-8") . ((10 < FastForm::str_utf8_mix_word_count($data->original)) ? "......" : "")), array("user/orderResult","orderId"=>$data->id),array("target"=>"_blank"))',
            'filter'=>false,
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
			'value'=>'("new" == $data->status and "file" == $data->type) ? Lookup::item("OrderStatus",$data->status) . "：正在<br />估算订单价格" : Lookup::item("OrderStatus",$data->status)',
			'filter'=>Lookup::items('OrderStatus'),

		),
        array(
            'header'=>'操作',
            'type'=>'raw',
            'value'=>'("new" != $data->status && "invalid" != $data->status) ? (CHtml::link((!empty($data->translation) && "finish" == $data->status) ? "修改译文" : "添加译文", array("user/FastEdit","orderId"=>$data->id),array("target"=>"_blank"))) : ""',
            'filter'=>false,
        ),
        array(
            'name'=>'create_time',
            'type'=>'raw',
            'value'=>'date("Y-m-d", $data->create_time) . "<br />&nbsp;&nbsp;" . date("H:i:s", $data->create_time)',
            'filter'=>false,
        ),
		/*
		'demand',
		'name',
		'phone',
		'email',
		'qq',
		'is_invoice',
		'type',
		'translation',
		'user_id',
		*/
        /*
		array(
			'class'=>'CButtonColumn',
        ),
         */
	),
)); ?>
