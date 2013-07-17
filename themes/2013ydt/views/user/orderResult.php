
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />
<?php
$this->pageTitle=Yii::app()->name . ' - 译文详情';
$this->breadcrumbs=array(
);
?>

    <div id="bd" class="trans-result others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content bd-content-special">
                        <ul class="resultView-nav">
                            <li class="current clog-js" data-act="fast-detail">译文详情</li>
							<?php if(!Yii::app()->user->checkAccess('member') && 0 != $model->user_id): ?>
							<li class="clog-js" data-act="fast-detail"><?php echo CHtml::link("查看会员信息",array("user/view","id"=>$model->user_id),array("target"=>"_blank")); ?></li>
							<?php endif; ?>
                                                    </ul>
                        <div class="resultView-content">
                            <div class="history-item translating">
                                                                <span class="time-and-see"><?php echo date("Y-m-d H:i:s", $model->completion_time ? $model->completion_time : $model->create_time); ?></span>
                                <span class="trans-resource history-layout">
                                    <?php
			                        if('fast' == $model->type && !empty($model->original))
				                        echo nl2br($model->original);
			                        elseif('file' == $model->type && !empty($model->document)) {
                                        echo CHtml::encode($model->document);
                                        echo "&nbsp;&nbsp;" . CHtml::link("下载原文",array('user/download','orderId'=>$model->id));
                                    }
			                        ?>
                                </span>
                                <span class="content-separate fix-vertical-middle">-&gt;</span>
                                <span class="trans-result history-layout">
                                    <?php
                                    if('finish' == $model->status)
                                    {
                                        if('fast' == $model->type && !empty($model->translation))
        		                            echo nl2br($model->translation);
        	                        elseif('file' == $model->type && !empty($model->t_document) && file_exists('upload/t/' . $model->t_upload_file_name))
        		                            echo CHtml::encode($model->t_document) . "&nbsp;&nbsp;" . CHtml::link("下载译文",array('user/downloadTDocument','orderId'=>$model->id));
                                    }
        	                        else
        		                        echo Lookup::item('OrderStatus',$model->status);
        	                        ?>
                                </span>
                            </div>

                            <div class="noticeCon">
                                <span class="title">需求备注：</span>
                                <p><?php echo CHtml::encode($model->demand); ?></p>
                            </div>  <div class="form"><div class="account-content user-contact">
<?php if("finish" == $model->status): ?>
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'comment-form',
	'enableAjaxValidation'=>false,
)); ?>

<h1>订单评价</h1>

<?php
$this->widget('ext.EUserFlash',array(
            'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"));
?>
<?php echo $form->labelEx($comment,'level',array("class"=>"com_left")); ?><div class="form-item-layout">
<!-- <?php echo $form->radioButtonList($comment,'level',Lookup::items("CommentLevel")); ?> -->
<?php echo $form->dropDownList($comment, 'level', Lookup::items('CommentLevel')); ?>
                                <?php echo $form->error($comment,'level'); ?>
</div>
<?php echo $form->labelEx($comment,'type',array("class"=>"com_left")); ?><div class="form-item-layout">
<?php echo $form->dropDownList($comment, 'type', Lookup::items('CommentType')); ?>
                                <?php echo $form->error($comment,'type'); ?></div>

<?php echo $form->labelEx($comment,'content',array("class"=>"com_left")); ?>
<div class="form-item-layout"> <?php echo $form->textArea($comment,'content', array('rows'=>6, 'cols'=>50)); ?>
                                <?php echo $form->error($comment,'content'); ?></div>
		<?php echo CHtml::submitButton($model->isNewRecord ? '新建' : '保存',array("class"=>"clog-js control-btn margin_120")); ?>
<?php $this->endWidget(); ?>
<?php endif; ?></div></div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
