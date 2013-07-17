<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 客户管理';
$this->breadcrumbs=array(
	'客户管理',
);
?>

    <div id="bd" class="account">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content result-list">
<?php $this->widget('zii.widgets.CMenu',array(
    'id'=>'category',
    'htmlOptions'=>array('class'=>'account-nav'),
    'activeCssClass'=>'current',
    'items'=>array(
    	array('label'=>'个人中心', 'url'=>array('proxy/panel'), 'visible'=>Yii::app()->user->checkAccess('agents')),
		 array('label'=>'客户管理', 'url'=>array('proxy/referral'), 'visible'=>Yii::app()->user->checkAccess('agents')),
	    //array('label'=>'收益管理', 'url'=>array('proxy/revenue'), 'visible'=>Yii::app()->user->checkAccess('agents')),
	    array('label'=>'完善资料', 'url'=>array('proxy/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('agents')),
    ),
)); ?>
                        <div class="account-content deal-accord">
<style>
.filters {
  display: none;
}
</style>

<p>
<?php $form=$this->beginWidget('CActiveForm', array(
    'id'=>'page-form',
    'enableAjaxValidation'=>true,
)); ?>

&nbsp;&nbsp;&nbsp;&nbsp;<b>从 :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'from_date',  // name of post parameter
    'value'=>(string)Yii::app()->request->cookies['from_date'],  // value comes from cookie after submittion
     'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'language' => 'zh_cn',
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>
&nbsp;&nbsp;&nbsp;&nbsp;<b>到 :</b>
<?php
$this->widget('zii.widgets.jui.CJuiDatePicker', array(
    'name'=>'to_date',
    'value'=>(string)Yii::app()->request->cookies['to_date'],
    'options'=>array(
        'showAnim'=>'fold',
        'dateFormat'=>'yy-mm-dd',
    ),
    'language' => 'zh_cn',
    'htmlOptions'=>array(
        'style'=>'height:20px;'
    ),
));
?>

&nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::submitButton('查询',array('style'=>"display: inline-block; margin-left: 10px; height: 28px; width: 68px; line-height: 28px; background: #2b5e9a; color: #fff;font-weight: bold;font-size: 12px; cursor: pointer;")); ?>
<?php $this->endWidget(); ?>

</p>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'charge-grid',
	'dataProvider'=>$model->search(),
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '共有{count}个客户，当前为第{start}～第{end}位。',
    'template' => "{summary}\n{pager}\n{items}\n{summary}\n{pager}",
    'itemsCssClass' => 'accord-table',
    'pager'=>array(
        'header'         => false,
        //'cssFile'=>Yii::app()->baseUrl . '/css/gridViewStyle/gridView.css',
        //'class'=>'CLinkPager',
        'firstPageLabel' => '首页',
        'prevPageLabel'  => '<<上一页',
        'nextPageLabel'  => '下一页>>',
        'lastPageLabel'  => '末页',
         'maxButtonCount' => 5,          //最大按钮数
    ),
	'filter'=>$model,
	'columns'=>array(
    array(
      'name'=>'yuid',
      'value' => '$data->yu["name"] ? $data->yu["name"] : $data->yu["email"]',
      'filter'=>false,
    ),
    array(
      'header'=>'注册时间',
      'type' => 'raw',
      'value'=>'date("Y-m-d", $data->yu["join_date"]) . "<br />" . date("H:i:s", $data->yu["join_date"])',
      'filter'=>false,
    ),
    array(
      'header'=>'订单数',
        'type'=>'raw',
        'value'=>'$data->yu["translateCount"] . "个"',
        'filter'=>false,
    ),
    array(
      'header'=>'消费金额',
      'type' => 'raw',
      'value'=>'$data->yu["priceSum"] . "元"',
      'filter'=>false,
      //'footer'=>"消费总额：<b>" . $model->yu["total_price"] . "</b>元",
    ),
	),
)); ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
