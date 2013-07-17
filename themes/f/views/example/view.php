<?php
$this->breadcrumbs=array(
	$model->title,
);

$this->menu=array(
	array('label'=>'新建', 'url'=>array('create')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'您确定要删除么，记录删除后将无法找回')),
	array('label'=>'翻译示例管理', 'url'=>array('admin')),
);
?>

<h1>查看示例 #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'title',
		'code',
		'original',
		'translation',
		'position',
	),
)); ?>
