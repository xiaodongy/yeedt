<?php $this->widget('zii.widgets.CMenu',array(
    'id'=>'category',
    'items'=>array(
	    array('label'=>$data->title, 'url'=>array('/path/example','type'=>$data->code)),
    ),
)); ?>