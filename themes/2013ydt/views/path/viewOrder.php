<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />
<?php
$this->pageTitle=Yii::app()->name . ' - 订单详情';
$this->breadcrumbs=array(
);
?>

<div id="bd" class="trans-result others">
<div class="bd-border">
  <div class="bd-padding">
    <div class="bd-inner-border">
      <div class="bd-content bd-content-special">
        <ul class="resultView-nav">
          <li class="current clog-js" data-act="fast-detail">订单详情</li>
          <?php if(!Yii::app()->user->checkAccess('member') && !Yii::app()->user->isGuest): ?>
          <li class="clog-js" data-act="fast-detail"><?php echo CHtml::link("查看会员信息",array("user/view","id"=>$model->user_id),array("target"=>"_blank")); ?></li>
          <?php endif; ?>
        </ul>
        <div class="resultView-content">
          <div class="history-item translating">
            <div class="detail-info"> 
              <!-- 文档更新内容开始 勿删！ -->
              <div class="hd">
                <ul class="step">
                  <li> <span><b>1</b>提交文档</span><i></i> </li>
                  <li class="current" data-status="2"> <span><b>2</b>确认报价</span><i></i> </li>
                  <li> <span><b>3</b>支付订单</span><i></i> </li>
                  <li> <span><b>4</b>翻译/审校</span><i></i> </li>
                  <li> <span><b>5</b>翻译完成</span><i></i> </li>
                  
                </ul>
              </div>
              <div class="bd">
                <div class="sys-pic"></div>
                <p class="sys-message">提交订单成功，正在估算价格，请稍等，10分钟后客服将电话联系您</p>
                <p class="sys-message">请您牢记订单号：<i><?php echo CHtml::encode($model->id)?></i></p>
                <p class="sys-message">若您关闭了此页面，可以在您的预留&nbsp; <a href="http://mail.<?php echo substr($model->email,strpos($model->email,"@")+1,strlen($model->email)); ?>" class="clog-js" target="_blank"
		                 data-act="toEmail">接收邮箱</a> &nbsp;再次访问。</p>
              </div>
              <div class="ft">
                <div class="order-detail">
                  <div class="title">订单信息</div>
                  <ul>
                    <li> <span>文档名：</span> <span><?php echo CHtml::encode($model->document); ?></span> </li>
                    <li> <span>订单号：</span> <span id="orderId"><?php echo CHtml::encode($model->id); ?></span> </li>
                    <li> <span>语言：</span> <span><?php echo CHtml::encode(Lookup::item("FileTranslateLanguages",$model->language)); ?></span> </li>
                    <li> <span>接收邮箱：</span> <span id="email"><?php echo CHtml::encode($model->email); ?></span> </li>
                    <li> <span class="mul-label">备注：</span> <span class="mul-content"><?php echo CHtml::encode($model->demand ? $model->demand : "无"); ?></span> </li>
                  </ul>
                </div>
                <div class="bank">
                  <div class="title">&nbsp;</div>
                  <ul>
                    <li> <span>质量级别：</span> <span> <?php echo CHtml::encode($model->quality_level ? Lookup::item("QualityLevels",$model->quality_level) : "待客服致电确认"); ?> </span> </li>
                    <li> <span>统计字数：</span> <span><?php echo CHtml::encode(0 != $model->word_count ? $model->word_count . " 个" : "待客服致电确认"); ?></span> </li>
                    <li> <span>订单金额：</span> <span><?php echo CHtml::encode(0 != $model->price ? $model->price . " 元" : "待客服致电确认"); ?></span> </li>
                    <li> <span>完成时间：</span> <span> <?php echo CHtml::encode($model->finish_time ? $model->finish_time : "待客服致电确认"); ?> </span> </li>
                  </ul>
                  <?php if ("new" == $model->status and 0 < $model->price): ?>
                  <p><?php echo CHtml::link("支付",array($pay_url,"orderId"=>$model->id)); ?></p>
                  <?php endif; ?>
                </div>
                <div class="clear"></div>
              </div>
              
              <!-- 文档更新内容结束 勿删！ --> 
              
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
