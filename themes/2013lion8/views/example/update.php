<?php
$this->breadcrumbs=array(
	'修改示例',
);

$this->menu=array(
	array('label'=>'新建', 'url'=>array('create')),
	array('label'=>'查看', 'url'=>array('view', 'id'=>$model->id)),
	array('label'=>'翻译示例管理', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
