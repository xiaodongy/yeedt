<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css">

<?php
$this->pageTitle=Yii::app()->name . ' - 确认订单信息';
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'check-rates-checkRates-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
    <div id="bd" class="trans-result others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(3000);$('.userflash_notice').fadeOut(3000);"
));
?>

                        <div class="history-item translating">
                            <span class="history-layout fix-vertical-top">
                                <h3>翻译文档</h3>
								<br />
								
                                <?php echo CHtml::encode($model->document) . "&nbsp;&nbsp;" . CHtml::link("下载原文", array("user/download","orderId"=>$model->id),array("target"=>"_blank")); ?>

<div class="noticeCon">
								<span class="title">下单时间：</span>
                                <p><?php echo date("Y-m-d H:i:s", $model->create_time); ?></p>
                                <span class="title">需求备注：</span>
                                <p><?php echo nl2br($model->demand); ?></p>
                				</div>
                                <div style="margin-left: 0px;" class="order-info">
                                    <p><?php echo CHtml::encode($model->name ? "姓名" : "会员ID"); ?>：<font class="big-word name-word">
<?php 
if(0 != $model->user_id)
	echo CHtml::link(CHtml::encode($model->name ? $model->name : $model->user_id), array("user/view","id"=>$model->user_id),array("target"=>"_blank","title"=>"查看会员信息"));
else
	echo CHtml::encode($model->name) . "&nbsp;&nbsp;(<i>未注册用户</i>)";
?>
</font></p>

                                    <p>联系电话：<font class="big-word name-word"><?php echo $model->phone; ?></font></p>

                                    <p>接收邮箱：<font class="big-word name-word"><?php echo $model->email; ?></font></p>

                                    <p>QQ号码：<font class="big-word name-word"><?php echo $model->qq; ?></font></p>
                </div>
							</span>
                            <span class="separate-line"></span>
                            <span class="history-layout fix-vertical-top">
                                <h3>核对订单信息</h3>
                                <br />
                                <div class="order-info">

                                    <p>字数：<?php echo $form->textField($model,'word_count',array('size'=>'10')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo str_replace("div","i",$form->error($model,'word_count',array("class"=>"demand-error-message"))); ?></p>
                                    <p>价格：<?php echo $form->textField($model,'price',array('size'=>'10')); ?> 元&nbsp;&nbsp;<?php echo str_replace("div","i",$form->error($model,'price',array("class"=>"demand-error-message"))); ?></p>
									<p>订单状态：<?php echo $form->dropDownList($model, 'status', CheckRates::getStatusForDropDownList("OrderStatus", $model->status)); ?><?php echo $form->error($model,'status'); ?></p>
									<p>客户反馈：<br /><?php echo $form->textArea($model,'remark',array('rows'=>5, 'cols'=>30, 'placeholder'=>'客户反馈信息可以填写在这里。')); ?></p>

								</div>
                                <div class="submit-btn"><?php echo CHtml::submitButton('确认订单信息',array("class"=>"control-btn confirm-pay-newpage clog-js")); ?></div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
