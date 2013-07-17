<?php
$this->breadcrumbs=array(
	'翻译示例管理',
);

$this->menu=array(
	array('label'=>'新建示例', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('example-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'example-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		//'id',
		'title',
		'code',
		//'original',
		//'translation',
		'position',
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
