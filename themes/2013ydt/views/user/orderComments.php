<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 客户反馈';
$this->breadcrumbs=array(
	'客户',
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
	'id'=>'comment-grid',
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
        array(
            'header' => "意见类型",
            'name' => 'type',
            'value' => 'Lookup::item("CommentType", $data->type)',
			'filter'=>Lookup::items('CommentType'),
        ),
        array(
            'name' => 'translate_id',
            'type' => 'raw',
            'value'=>'CHtml::link(CHtml::encode($data->translate_id),array("user/orderResult", "orderId"=>$data->translate_id),array("target"=>"_blank"))',
        ),
        array(
            'header' => "满意度",
            'name' => 'level',
            'value' => 'Lookup::item("CommentLevel", $data->level)',
			'filter'=>Lookup::items('CommentLevel'),
        ),
        array(
            'header' => "反馈内容",
            'value' => 'CHtml::encode($data->content)',
            'htmlOptions'=>array('class'=>'main-content'),
        ),
        array(
            'header' => "评价时间",
            'value' => 'CHtml::encode(date("Y-m-d h:i:s", $data->create_time))',
        ),
	),
)); ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
