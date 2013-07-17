<?php
$this->breadcrumbs=array(
	'订单号：' . $model->id,
);
?>

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(3000);$('.userflash_notice').fadeOut(3000);"
));
?>

<h1>译文详情</h1>

<div class="resultView-content">
	<p class="time-and-see"><?php echo date("Y-m-d H:i:s", $model->create_time); ?></p>
	<div class="history-item">
		<div class="trans-resource">
			<?php
			if('fast' == $model->type && !empty($model->original))
				echo nl2br($model->original);
			elseif('file' == $model->type && !empty($model->document))
				echo CHtml::encode($model->document);
			?>
		</div>
        <div class="fix-vertical-middle">&nbsp;-&gt;</div>
        <div class="trans-result">
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
        </div>
    </div>
    <hr />
</div>

<div class="noticeCon">
	<span class="title"><?php echo $model->getAttributeLabel('demand'); ?>：</span>
    <p><?php echo nl2br($model->demand); ?></p>
</div>

<div class="noticeCon">
	<span class="title">联系信息：</span>
    <p>
        <?php
        if($model->name)
            echo $model->getAttributeLabel('name') . "：" . CHtml::encode($model->name) . "<br />";
        if($model->phone)
            echo $model->getAttributeLabel('phone') . "：" . CHtml::encode($model->phone) . "<br />";
            if($model->email)
                echo $model->getAttributeLabel('email') . "：" . CHtml::mailto(CHtml::encode($model->email),$model->email) . "<br />";
            if($model->qq)
                echo $model->getAttributeLabel('qq') . "：" . CHtml::mailto(CHtml::encode($model->email),$model->qq);
        ?>
    </p>
</div>
