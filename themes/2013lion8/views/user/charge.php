<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 帐户充值';
$this->breadcrumbs=array(
	'帐户充值',
);
?>

    <div id="bd" class="account">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
						
                       	<div id="chongzhi">
<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'charge-form',
    'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
                            <div class="user-info has-layout">
                                <div class="precharge-intro">
                                    <span class="title">
                                        <i style="font-weight:bold;font-size:14px;">提示：</i>一次充值，多次支付
                                    </span>

                                    <p>如果您所充金额超过当次消费金额，所剩余额会存储在您的账户中，之后每次翻译消费都可使用账户中余额直接进行付费，省去了每次充值的麻烦。</p>

                                    <p>所剩余额，均可电话申请退款。</p>
                                </div>
                                <div class="pay-method">
                                    <span class="title">账户充值</span>
                                    <label>当前余额：</label>
                                    <div class="form-item-layout"><i class="large"><?php echo User::model()->findByPk(Yii::app()->user->id)->balance; ?></i> 元</div>

                                    <div style="position:relative;">
                                        <?php echo $form->labelEx($model,'money',array("for"=>"rechargeNum")); ?>
                                        
                                        <div class="form-item-layout">
                                            <span id="rechargeUnit"><?php echo $form->textField($model,'money'); ?>元</span>
                                            <span style="margin-left: 5px;"><?php echo str_replace("div","i",$form->error($model,'money',array("class"=>"demand-error-message"))); ?></span>
                                        </div>
                                        
                               		</div>
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
//$radioList = str_replace('中国工商银行','<div class="image"><label class="sp icbc" for="ChargeForm_recharge_way_1"></label></div>',$form->radioButtonList($model,'recharge_way',Lookup::radioItems("BanksType")));
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
	<input id="ytChargeForm_recharge_way" type="hidden" value="" name="ChargeForm[recharge_way]" />
<input id="ChargeForm_recharge_way_0" type="radio" value="alipay" name="ChargeForm[recharge_way]">
</div>
<div class="image">
<label class="sp alipay" for="ChargeForm_recharge_way_0"></label>
</div>

                                </div>
                            </div>
                            <div class="has-layout user-info charge-source bottom">
                                <span>2. 网银支付</span>

                                <div class="has-layout line">
                                    <div class="radio">
                                        <input type="radio" value="ICBCB2C" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_1">
                                    </div>
                                    <div class="image"><label class="sp icbc" for="ChargeForm_recharge_way_1"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CMB" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_2">
                                    </div>
                                    <div class="image"><label class="sp cmb" for="ChargeForm_recharge_way_2"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CCB" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_3">
                                    </div>
                                    <div class="image"><label class="sp ccb" for="ChargeForm_recharge_way_3"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="BOCB2C" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_4">
                                    </div>
                                    <div class="image"><label class="sp boc" for="ChargeForm_recharge_way_4"></label></div>
                                </div>
                                <div class="has-layout line" id="line1">
                                    <a href="javascript:void(0)" id="moreBank">&nbsp;显示所有银行&nbsp;</a>
                                </div>
                                <div class="has-layout hidden line" id="line2">
                                    <div class="radio">
                                        <input type="radio" value="ABC" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_5">
                                    </div>
                                    <div class="image"><label class="sp abc" for="ChargeForm_recharge_way_5"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="COMM" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_6">
                                    </div>
                                    <div class="image"><label class="sp jiaotong" for="ChargeForm_recharge_way_6"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CIB" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_7">
                                    </div>
                                    <div class="image"><label class="sp xingye" for="ChargeForm_recharge_way_7"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CEBBANK" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_8">
                                    </div>
                                    <div class="image"><label class="sp guangda" for="ChargeForm_recharge_way_8"></label></div>
                                </div>
                                <div class="has-layout hidden line" id="line3">
                                    <div class="radio">
                                        <input type="radio" value="SPDB" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_9">
                                    </div>
                                    <div class="image"><label class="sp pudongfz" for="ChargeForm_recharge_way_9"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="GDB" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_10">
                                    </div>
                                    <div class="image"><label class="sp guangdongfz" for="ChargeForm_recharge_way_10"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="CITIC" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_11">
                                    </div>
                                    <div class="image"><label class="sp zhongxin" for="ChargeForm_recharge_way_11"></label></div>
                                    <div class="radio">
                                        <input type="radio" value="SDB" name="ChargeForm[recharge_way]" id="ChargeForm_recharge_way_12">
                                    </div>
                                    <div class="image"><label class="sp shenzhenfz" for="ChargeForm_recharge_way_12"></label></div>
                                </div>
                            </div>
                            <div style="height:20px;" class="has-layout user-info charge-source">
                                <span>3. 线下银行汇款<span style="font-weight:normal;">，请点击<?php echo CHtml::link("这里",array('/path/about',"#"=>"doc-zhifu"),array("target"=>"_blank")); ?>查看详情。</span>
                                </span>
                            </div>
                            <div style="position:relative;" class="user-info charge-control has-layout">
                                <?php echo CHtml::button('充值', array('submit' => array('user/charge','source'=>'account'),"class"=>"clog-js control-btn")); ?>
                                <!--
                                <span class="hidden" id="chargeErrorMsg" style="display: none;"></span>-->
                            </div>
                       
                                

                                <div class="read-agreement">
                                    <input type="checkbox" checked="true" id="alreadyRead"><label for="alreadyRead">我已阅读并同意<?php echo CHtml::link("《译点通专业翻译服务条款》",array('/path/server',"#"=>"doc-zhifu"),array("target"=>"_blank")); ?></label>
                                </div>
<?php $this->endWidget(); ?>
</div><!-- form -->
                           </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="http://shared.ydstatic.com/at/1.9.6/scripts/business.js" data-main="business/charge"></script>
