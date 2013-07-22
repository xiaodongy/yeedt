<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 支付订单';
$this->breadcrumbs=array(
	'支付订单',
);
?>

    <div id="bd" class="others recharge">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
 <div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'chongzhi-form',
    'enableAjaxValidation'=>false,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
                            <div class="has-layout charge-source bottom">
                                <p class="tips-submit-suc">
                                    您的订单已提交成功，请尽快付款！
                                </p>
                            </div>
                            <div class="user-info has-layout  charge-source bottom">
                                <div class="pay-method has-layout user-info ">
                                    <span class="title">请输入支付金额</span>
                                    <div class="accounts">
                                        <label>订单金额：</label>
                                        <i id="price" class="large"><?php echo $order->price; ?>元</i>
                                    </div>

                                    <?php echo $form->labelEx($model,'money',array("for"=>"rechargeNum","class"=>"rest-pay")); ?>
                                    <div class="form-item-layout">
                                        <span id="rechargeUnit"><?php echo $form->textField($model,'money',array("readonly"=>"readonly")); ?>元</span>
                                    </div>
				    <?php echo $form->error($model,'money',array("class"=>"in-tip")); ?>
                                </div>
                            </div>
							<!--
                            <div class="has-layout user-info charge-source bottom">
                                <div style="margin-bottom:10px;">请选择充值方式：</div>
                                
                                <span>1. 支付宝或网上银行</span>
								<span style="margin-left: 5px;"><?php // echo str_replace("div","i",$form->error($model,'recharge_way',array("class"=>"demand-error-message"))); ?></span>
                                <div class="has-layout line">
                                    <div class="radio">
<?php
//$radioList = str_replace("label","i",$form->radioButtonList($model,'recharge_way',Lookup::radioItems("BanksType")));

//$radioList = str_replace('label','i',$form->radioButtonList($model,'recharge_way',Lookup::radioItems("BanksType")));
//$radioList = str_replace('中国工商银行','<div class="image"><label class="sp icbc" for="ChongzhiForm_recharge_way_1"></label></div>',$form->radioButtonList($model,'recharge_way',Lookup::radioItems("BanksType")));
//echo $radioList;
?>
                                    </div>
                                </div>
                            </div>
							-->
							
							
                            <div class="has-layout user-info charge-source bottom">
                                <div style="margin-bottom:10px;">请选择充值方式：</div>              
                                <span>1. 支付宝或网上银行</span>
								<span style="margin-left: 5px;"><?php echo str_replace("div","i",$form->error($model,'recharge_way',array("class"=>"demand-error-message"))); ?></span>
                                <div class="has-layout line">
<div class="radio">
	<input id="ytChargeForm_recharge_way" type="hidden" value="" name="ChongzhiForm[recharge_way]" />
<input id="ChongzhiForm_recharge_way_0" type="radio" value="alipay" name="ChongzhiForm[recharge_way]">
</div>
<div class="image">
<label class="sp alipay" for="ChongzhiForm_recharge_way_0"></label>
</div>

                                </div>
                            </div>
                            <div class="has-layout user-info charge-source bottom">
                                <span>2. 网银支付</span>

                                <div class="has-layout line">
                                    <div class="radio">
                                        <input type="radio" value="ICBCB2C" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_1">
                                    </div>
                                    <div class="image"><label class="sp icbc" for="ChongzhiForm_recharge_way_1"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CMB" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_2">
                                    </div>
                                    <div class="image"><label class="sp cmb" for="ChongzhiForm_recharge_way_2"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CCB" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_3">
                                    </div>
                                    <div class="image"><label class="sp ccb" for="ChongzhiForm_recharge_way_3"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="BOCB2C" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_4">
                                    </div>
                                    <div class="image"><label class="sp boc" for="ChongzhiForm_recharge_way_4"></label></div>
                                </div>
                                <div class="has-layout line" id="line1">
                                    <a href="javascript:void(0)" id="moreBank">&nbsp;显示所有银行&nbsp;</a>
                                </div>
                                <div class="has-layout hidden line" id="line2">
                                    <div class="radio">
                                        <input type="radio" value="ABC" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_5">
                                    </div>
                                    <div class="image"><label class="sp abc" for="ChongzhiForm_recharge_way_5"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="COMM" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_6">
                                    </div>
                                    <div class="image"><label class="sp jiaotong" for="ChongzhiForm_recharge_way_6"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CIB" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_7">
                                    </div>
                                    <div class="image"><label class="sp xingye" for="ChongzhiForm_recharge_way_7"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CEBBANK" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_8">
                                    </div>
                                    <div class="image"><label class="sp guangda" for="ChongzhiForm_recharge_way_8"></label></div>
                                </div>
                                <div class="has-layout hidden line" id="line3">
                                    <div class="radio">
                                        <input type="radio" value="SPDB" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_9">
                                    </div>
                                    <div class="image"><label class="sp pudongfz" for="ChongzhiForm_recharge_way_9"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="GDB" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_10">
                                    </div>
                                    <div class="image"><label class="sp guangdongfz" for="ChongzhiForm_recharge_way_10"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CITIC" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_11">
                                    </div>
                                    <div class="image"><label class="sp zhongxin" for="ChongzhiForm_recharge_way_11"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="SDB" name="ChongzhiForm[recharge_way]" id="ChongzhiForm_recharge_way_12">
                                    </div>
                                    <div class="image"><label class="sp shenzhenfz" for="ChongzhiForm_recharge_way_12"></label></div>
                                </div>
                            </div>

                            <div class="has-layout user-info charge-source bottom">
                                <span  class="l-title">3. 线下银行汇款</span>
                                <p class="t-more">点击<?php echo CHtml::link("这里",array('/path/about',"#"=>"doc-zhifu"),array("target"=>"_blank")); ?>查看详情，或咨询客服。</p>
                            </div>
                            <div class="user-info charge-control has-layout" style="position:relative;">
                                <?php echo CHtml::button('下一步', array('submit' => array('path/filePay','source'=>$order->type,'orderId'=>$order->id,'userId'=>$order->email),"class"=>"clog-js control-btn")); ?>
                                <span id="nextStep" class="next-step">将会去往您选择的支付页面</span>
                                <span id="chargeErrorMsg" class="hidden"></span>

                                <div class="read-agreement">
                                    <input id="alreadyRead" type="checkbox" checked="true" /><label
                                    for="alreadyRead">我已阅读并同意<?php echo CHtml::link("《译点通专业翻译服务条款》",array('/path/server',"#"=>"doc-zhifu"),array("target"=>"_blank")); ?></label>
                                </div>
                            </div>
<?php $this->endWidget(); ?>

</div><!-- form -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://shared.ydstatic.com/at/1.9.6/scripts/business.js" data-main="business/charge"></script>
