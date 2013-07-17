	<div class="history-item havent-pay">
		<span class="time-and-see">
			<?php echo CHtml::encode(date('Y-m-d G:i:s',$data->create_time)); ?>
			<?php
			if (20 < $data->word_count)
				echo CHtml::link(CHtml::encode("查看全部"),array("user/orderResult","orderId"=>$data->id),array("class"=>"see-all clog-js"));
			?>
		</span>
		<span class="trans-resource history-layout">
			<?php
			if (20 < $data->word_count){
				$num = (strpos($data->language,'ch_') === false) ? 40 : 100;
				echo nl2br(CHtml::encode(mb_substr(strip_tags($data->original), 0, $num, "utf-8")));
			} else
				echo nl2br(CHtml::encode($data->original));
			?>
		</span>
		<span class="content-separate fix-vertical-middle"></span>
		<span class="trans-result history-layout caozuo fix-vertical-middle">
			<i><?php echo CHtml::encode(Lookup::item("OrderStatus",$data->status)); ?></i><br>
			<?php echo CHtml::link("[支付]",array("user/orderPay","orderId"=>$data->id),array("class"=>"continue clog-js","target"=>"_blank")); ?>
			<?php echo CHtml::link("[编辑]",array("path/fast","orderId"=>$data->id),array("class"=>"edit clog-js")); ?>
		</span>
	</div>