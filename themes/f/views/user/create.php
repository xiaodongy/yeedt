<?php
$this->breadcrumbs=array(
	'新建帐号',
);

$this->menu=array(
	array('label'=>'帐号管理', 'url'=>array('admin')),
);
?>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>
