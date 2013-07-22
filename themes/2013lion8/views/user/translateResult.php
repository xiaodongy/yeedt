<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 翻译记录';
$this->breadcrumbs=array(
	'翻译记录',
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
    'activeCssClass'=>'current',
    'items'=>array(
    	array('label'=>'我的帐户', 'url'=>array('user/panel'), 'visible'=>Yii::app()->user->checkAccess('member')),
	
	    array('label'=>'翻译记录', 'url'=>array('user/translateResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'交易记录', 'url'=>array('user/chargeResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'联系方式', 'url'=>array('user/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('member')),
		array('label'=>'我的邀请', 'url'=>array('user/referral'), 'visible'=>Yii::app()->user->checkAccess('member')),
    ),
)); ?>
                        <div class="account-content trans-accord">

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(3000);$('.userflash_notice').fadeOut(3000);"
));
?>
                            <!--
                            <div class="accord-nav">
                                <a href="" class="current" data-act="all-record">全部</a>
                                <a class="clog-js" href="account02.html" data-act="paid-record">已完成</a>
                                <a class="clog-js" href="account02.html" data-act="unpaid-record">未支付</a>
                                <a class="clog-js" href="account02.html" data-act="translating-record">翻译中</a>
                            </div>
                            -->
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translate-grid',
	'dataProvider'=>$model->search(),
    //'template' => '{items}{summary}',
    //'selectableRows'=>1,
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '',
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
            'filter'=>false,
        ),
		array(
			'name'=>'language',
			'value'=>'Lookup::item("FileTranslateLanguages",$data->language)',
            'filter'=>false,
		),
        array(
            'header'=>'主题',
            'type'=>'raw',
            'value'=>'CHtml::link(isset($data->original) ? CHtml::encode(mb_substr(strip_tags($data->original), 0, 20, "utf-8") . ((10 < FastForm::str_utf8_mix_word_count($data->original)) ? "......" : "")) : CHtml::encode($data->document), array("user/orderResult","orderId"=>$data->id),array("target"=>"_blank")) . (("finish" == $data->status && "file" == $data->type) ? "&nbsp;&nbsp;" . CHtml::link("下载译文",array("user/downloadTDocument","orderId"=>$data->id)) : "")',
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
			'value'=>'("new" == $data->status and "file" == $data->type) ? Lookup::item("OrderStatus",$data->status) . (0 == $data->price ? "：正在估算订单价格" : "") : Lookup::item("OrderStatus",$data->status)',
			'filter'=>Lookup::items('OrderStatus'),
			//'filter'=>false,
		),
        array(
            'header'=>'操作',
            'type'=>'raw',
            'value'=>'(("new" == $data->status and 0 < $data->price) ? CHtml::link("支付",array("user/orderPay","orderId"=>$data->id),array("target"=>"_blank")) . "&nbsp;&nbsp;" : "") . CHtml::link("删除","javascript:void(0)",array("submit"=>array("translate/delete","id"=>$data->id),"confirm" => "您确定要删除么，记录删除后将无法找回","class"=>"del"))',
        ),
        array(
            'name'=>'create_time',
            'type'=>'raw',
            'value'=>'date("Y-m-d", $data->create_time) . "<br />" . date("H:i:s", $data->create_time)',
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
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
