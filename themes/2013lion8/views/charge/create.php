<?php
$this->breadcrumbs=array(
	'Charges'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Charge', 'url'=>array('index')),
	array('label'=>'Manage Charge', 'url'=>array('admin')),
);
?>

<h1>Create Charge</h1>

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?>