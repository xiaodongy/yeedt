<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('id')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->id), array('view', 'id'=>$data->id)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('chargetype')); ?>:</b>
	<?php echo CHtml::encode($data->chargetype); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('money')); ?>:</b>
	<?php echo CHtml::encode($data->money); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('charge_time')); ?>:</b>
	<?php echo CHtml::encode($data->charge_time); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('recharge_way')); ?>:</b>
	<?php echo CHtml::encode($data->recharge_way); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('translate_id')); ?>:</b>
	<?php echo CHtml::encode($data->translate_id); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('user_id')); ?>:</b>
	<?php echo CHtml::encode($data->user_id); ?>
	<br />


</div>