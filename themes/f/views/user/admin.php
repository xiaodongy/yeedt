<?php
$this->breadcrumbs=array(
	'帐号管理',
);

$this->menu=array(
	array('label'=>'新建帐号', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('user-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'user-grid',
	'dataProvider'=>$model->search(),
    'enableSorting'=>false,
    'enablePagination'=>true,
	'filter'=>$model,
	'columns'=>array(
		//'id',
		array(
			'name'=>'name',
            'type'=>'raw',
			'value'=>'CHtml::link(CHtml::encode($data->name), array("user/view","id"=>$data->id),array("target"=>"_blank"))',
		),
		'email',
		'phone',
		array(
			'name'=>'roles',
            'type'=>'raw',
			'value'=>'CHtml::encode(Lookup::item("UserRoles",$data->roles))',
			'filter'=>Lookup::items('UserRoles'),
		),
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
