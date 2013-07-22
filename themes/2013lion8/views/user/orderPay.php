<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css">

<?php
$this->pageTitle=Yii::app()->name . ' - 确认订单';
$this->breadcrumbs=array(
);
?>

<?php if("fast" == $model->type) {
    $title = "翻译内容";
    $content = $model->original;
} else {
    $title = "翻译文档";
    $content = $model->document;
}
?>
    <div id="bd" class="trans-result others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
                        <div class="history-item translating">
                            <span class="history-layout fix-vertical-top">
                                <h3><?php echo $title; ?></h3>
                                <br />
                                <?php echo $content; ?>
                            </span>
                            <span class="separate-line"></span>
                            <span class="history-layout fix-vertical-top">
                                <h3>核对订单信息</h3>
                                <br />
                                <div class="order-info">
                                    <p>用户名：<font class="big-word name-word"><?php echo CHtml::encode(Yii::app()->user->email); ?></font></p>

                                    <p>订单号：<font class="big-word name-word"><?php echo CHtml::encode($model->id); ?></font></p>

                                    <p>统计字数：<font class="big-word num-word"><?php echo CHtml::encode($model->word_count); ?>字</font></p>

                                    <p>应付金额：<font class="big-word num-word"><?php echo CHtml::encode($model->price); ?>元</font></p>
                                </div>
                                <div class="submit-btn">
<?php echo CHtml::button('确认订单', array('submit' => array('user/orderPay',"orderId"=>$model->id,"pay"=>1),"class"=>"control-btn confirm-pay-newpage clog-js")); ?>
                                </div>
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
