<?php
$this->breadcrumbs=array(
	'Translates'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'List Translate', 'url'=>array('index')),
	array('label'=>'Create Translate', 'url'=>array('create')),
);

Yii::app()->clientScript->registerScript('search', "
$('.search-button').click(function(){
	$('.search-form').toggle();
	return false;
});
$('.search-form form').submit(function(){
	$.fn.yiiGridView.update('translate-grid', {
		data: $(this).serialize()
	});
	return false;
});
");
?>

<h1>Manage Translates</h1>

<p>
You may optionally enter a comparison operator (<b>&lt;</b>, <b>&lt;=</b>, <b>&gt;</b>, <b>&gt;=</b>, <b>&lt;&gt;</b>
or <b>=</b>) at the beginning of each of your search values to specify how the comparison should be done.
</p>

<?php echo CHtml::link('Advanced Search','#',array('class'=>'search-button')); ?>
<div class="search-form" style="display:none">
<?php $this->renderPartial('_search',array(
	'model'=>$model,
)); ?>
</div><!-- search-form -->

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'translate-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
	'columns'=>array(
		'id',
		'language',
		'original',
		'document',
		'upload_file_name',
		'word_count',
		/*
		'price',
		'demand',
		'name',
		'phone',
		'email',
		'qq',
		'is_invoice',
		'type',
		'status',
		'create_time',
		'translation',
		'user_id',
		*/
		array(
			'class'=>'CButtonColumn',
		),
	),
)); ?>
