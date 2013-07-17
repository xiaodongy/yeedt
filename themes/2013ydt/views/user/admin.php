<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />
<?php
$this->pageTitle=Yii::app()->name . ' - 用户管理';
$this->breadcrumbs=array(
	'用户管理',
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
    	array('label'=>'用户管理', 'url'=>array('user/admin')),
	),
)); ?>

    <div class="account-content user-contact">
<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translate-grid',
	'dataProvider'=>$model->search(),
    //'template' => '{items}{summary}',
    //'selectableRows'=>1,
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '第{start}～第{end}个，共{count}个用户',
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
		//'id',
		array(
			'name'=>'name',
            'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name ? $data->name : $data->id), array("user/view","id"=>$data->id),array("target"=>"_blank"))',
		),
		'email',
		'phone',
		array(
			'name'=>'roles',
            'type'=>'raw',
			'value'=>'CHtml::encode(Lookup::item("UserRoles",$data->roles))',
			'filter'=>Lookup::items('UserRoles'),
		),
		//'join_date',
		//'password',
		//'name',
		//'receive_email',
		/*
		'qq',
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
