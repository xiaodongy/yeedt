<?php
$this->breadcrumbs=array(
	'Charges',
);

$this->menu=array(
	array('label'=>'Create Charge', 'url'=>array('create')),
	array('label'=>'Manage Charge', 'url'=>array('admin')),
);
?>

<h1>Charges</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
