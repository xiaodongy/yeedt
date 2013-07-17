<?php
$this->pageTitle=Yii::app()->name . ' - 翻译示例';
$this->breadcrumbs=array(
	$model->title,
);
?>

<?php $this->widget('zii.widgets.CListView',array(
    'id'=>'category',
    'dataProvider'=>$dataProvider,
    'summaryText' => '',
	'itemView'=>'_exampleMenu',
)); ?>

<h1>原文：</h1>
<p><?php echo $model->original; ?></p>

<h1>译文：</h1>
<p><?php echo $model->translation; ?></p>
