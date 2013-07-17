<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css">

<?php
$this->pageTitle=Yii::app()->name . ' - 提交译文';
$this->breadcrumbs=array(
    '订单号：' . $model->id,
);?>

    <div id="bd" class="trans-result others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content bd-content-special">
                        <ul class="resultView-nav">
                            <li class="current clog-js" data-act="fast-detail">提交译文</li>
							<li class="clog-js" data-act="fast-detail"><?php echo CHtml::link("查看会员信息",array("user/view","id"=>$model->user_id),array("target"=>"_blank")); ?></li>
                                                    </ul>
                        <div class="resultView-content">
                            <div class="history-item translating">
                                                                <span class="time-and-see"><?php echo date("Y-m-d H:i:s", $model->create_time); ?></span>
                                <span class="trans-resource history-layout">
                                    <?php
			                        if('fast' == $model->type && !empty($model->original))
				                        echo nl2br($model->original);
			                        elseif('file' == $model->type && !empty($model->document))
				                        echo CHtml::encode($model->document);
			                        ?>
                                </span>
                                <span class="content-separate fix-vertical-middle">-&gt;</span>
                                <span class="trans-result history-layout">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'fast-edit-fastedit-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
    'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

<div class="row">
    <?php echo $form->textArea($model,'translation',array('rows'=>18, 'cols'=>40, 'placeholder'=>'译文内容请填写在这里。')); ?>
</div>
<div class="row">
    <?php echo CHtml::submitButton('提交译文', array("class"=>"clog-js control-btn")); ?>
</div>
                                </span>
                            </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
                                                        <div class="noticeCon">
                                <span class="title">需求备注：</span>
                                <p><?php echo nl2br($model->demand); ?></p>
                                <span class="title">电话：</span>
                                <p><?php echo nl2br($model->phone); ?></p>

                            </div>
                                                    </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
