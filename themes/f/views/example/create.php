<?php
$this->breadcrumbs=array(
	'新建示例',
);

$this->menu=array(
	array('label'=>'翻译示例管理', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
