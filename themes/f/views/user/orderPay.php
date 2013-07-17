	<div class="row">
<?php if("fast" == $model->type) {
    $title = "翻译内容";
    $content = $model->original;
} else {
    $title = "翻译文档";
    $content = $model->document;
}
?>
        <h5><?php echo $title; ?></h5>
        <p><?php echo $content; ?></p>
    </div>
<hr />
	<div class="row">
        <h5>核对订单信息</h5>
        用户名：<?php echo CHtml::encode(Yii::app()->user->email); ?><br />
        订单号：<?php echo CHtml::encode($model->id); ?><br />
        统计字数：<?php echo CHtml::encode($model->word_count); ?> 字<br />
        应付金额：<?php echo CHtml::encode($model->price); ?> 元
    </div>

	<div class="row buttons">
		<?php echo CHtml::button('确认订单', array('submit' => array('user/orderPay',"orderId"=>$model->id,"pay"=>1))); ?>
	</div>
