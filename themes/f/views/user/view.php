<?php
$this->breadcrumbs=array(
    '账户详细信息',
);

$this->menu=array(
	array('label'=>'帐号管理', 'url'=>array('admin')),
	array('label'=>'修改', 'url'=>array('update', 'id'=>$model->id)),
	array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->id),'confirm'=>'你确定要删除此帐号么，记录删除后将无法找回')),
	array('label'=>'新建帐号', 'url'=>array('create')),
);
?>

<h1>帐号ID #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
        array(
            'name'=>'roles',
            'value'=>CHtml::encode(Lookup::item('UserRoles', $model->roles)),
        ),
		//'id',
		array(
			'name' => 'email',
			'type' => 'raw',
			'value'=>CHtml::mailto(CHtml::encode($model->email),$model->email,array("title"=>"发送邮件给：" . $model->name)),
		),
		'password',
		'name',
		'phone',
		array(
			'name' => 'receive_email',
			'type' => 'raw',
			'value'=>CHtml::mailto(CHtml::encode($model->receive_email),$model->receive_email,array("title"=>"发送邮件给：" . $model->receive_email)),
		),
		'qq',
        //'roles'
	),
)); ?>
