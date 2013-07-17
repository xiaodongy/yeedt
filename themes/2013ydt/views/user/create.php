<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

﻿<?php
$this->breadcrumbs=array(
    '新建用户',
);
?>

    <div id="bd" class="account">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
<?php $this->widget('zii.widgets.CMenu',array(
    'id'=>'category',
    'htmlOptions'=>array('class'=>'account-nav'),
    'activeCssClass'=>'current',
    'items'=>array(
    	array('label'=>'用户管理', 'url'=>array('user/admin')),
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
