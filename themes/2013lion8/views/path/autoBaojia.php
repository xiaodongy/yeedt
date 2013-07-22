<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css">

<?php
$this->pageTitle=Yii::app()->name . ' - 确认订单信息';
$this->breadcrumbs=array(
);
?>

<?php $form=$this->beginWidget('CActiveForm', array(
'id'=>'auto-baojia-AutoBaojia-form',
	//'enableAjaxValidation'=>true,
	//'enableClientValidation'=>true,
	'clientOptions'=>array(
        //'validateOnSubmit'=>true,
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
<div class="noticeCon">
								<span class="title">下单时间：</span>
                                <p><?php echo date("Y-m-d H:i:s", $model->create_time); ?></p>
                                <span class="title">需求备注：</span>
                                <p><?php echo nl2br($model->demand); ?></p>
                				</div>
                                <div style="margin-left: 0px;" class="order-info">
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
									<p>质量等级：<?php echo $form->dropDownList($model, 'quality_level', Lookup::items('QualityLevels')); ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo str_replace("div","i",$form->error($model,'quality_level',array("class"=>"demand-error-message"))); ?></p>
                                    <p>字数：<?php echo CHtml::encode($model->word_count); ?>个</p>
                                    <p>价格：<?php echo CHtml::encode($model->price); ?>元</p>
									<p>完成时间：<?php echo CHtml::encode($model->finish_time); ?></p>

								</div>
                                <div class="submit-btn"><?php echo CHtml::submitButton('确认订单价格',array("class"=>"control-btn confirm-pay-newpage clog-js")); ?></div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $this->endWidget(); ?>
