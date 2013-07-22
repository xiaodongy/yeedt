<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

    <div id="bd" class="account">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">

<?php
$this->pageTitle=Yii::app()->name . ' - 修改用户信息';
$this->breadcrumbs=array(
    '修改用户信息',
);
?>

<?php $this->widget('zii.widgets.CMenu',array(
    'id'=>'category',
    'htmlOptions'=>array('class'=>'account-nav'),
    'activeCssClass'=>'current',
    'items'=>array(
		array('label'=>'会员信息', 'url'=>array('user/view', 'id'=>$model->id)),
    	array('label'=>'用户管理', 'url'=>array('user/admin')),
	    array('label'=>'修改', 'url'=>array('user/update', 'id'=>$model->id), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'删除', 'url'=>'#', 'linkOptions'=>array('submit'=>array('user/delete','id'=>$model->id),'confirm'=>'你确定要删除此帐号么，记录删除后将无法找回')),
	),
)); ?>

    <div class="account-content user-contact">

<?php echo $this->renderPartial('_form', array('model'=>$model)); ?> 

                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
