<?php
$this->breadcrumbs=array(
	'Translates'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Translate', 'url'=>array('index')),
	array('label'=>'Manage Translate', 'url'=>array('admin')),
);
?>

<h1>Create Translate</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>