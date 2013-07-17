<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/account.css" />

<?php
$this->pageTitle=Yii::app()->name . ' - 我的邀请';
$this->breadcrumbs=array(
	'我的邀请',
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
    	array('label'=>'我的帐户', 'url'=>array('user/panel'), 'visible'=>Yii::app()->user->checkAccess('member')),
		 
	    array('label'=>'翻译记录', 'url'=>array('user/translateResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'交易记录', 'url'=>array('user/chargeResult'), 'visible'=>Yii::app()->user->checkAccess('member')),
	    array('label'=>'联系方式', 'url'=>array('user/getUserInfo'), 'visible'=>Yii::app()->user->checkAccess('member')),
		 array('label'=>'我的邀请', 'url'=>array('user/referral'), 'visible'=>Yii::app()->user->checkAccess('member')),
    ),
)); ?>
                        <div class="account-content deal-accord"> <h1>邀请好友</h1><div class="share-list">
<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(3000);$('.userflash_notice').fadeOut(3000);"
));
?>
                          <div class="blk im"> <div class="logo"><img src="http://s1.meituan.net/css/i/logo_qq.gif" width="48" height="48" /></div> 
                           <div class="info"><table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td><h4 style="color: #349835;margin-bottom: 5px;font-size: 15px;">这是您的专用邀请链接，请通过 QQ 或 MSN 发送给好友：</h4></td>
    <td></td>
  </tr>
  <tr>
    <td>   <textarea readonly id="share-copy-text" onfocus="this.select()" onmouseover="this.select()" onclick="this.select()" class="f-textarea">我最近在使用译点通专业翻译，人工在线翻译，服务好，快速准确，价格实惠，快来试试吧！ <?php echo Yii::app()->request->hostInfo . Yii::app()->createUrl('/user/r',array('i'=>'i' . Yii::app()->user->id));?></textarea></td>
    <td><button type="button" onclick='javascript:copyToClipboard("share-copy-text",true);' class='form-button' />复制</button></td>
  </tr>
  <tr>
    <td><!-- Baidu Button BEGIN -->
<div id="bdshare" class="bdshare_t bds_tools get-codes-bdshare"  data="{'url':'<?php echo Yii::app()->request->hostInfo . Yii::app()->createUrl("/user/r",array("i"=>"i" . Yii::app()->user->id));?>'}">

<a class="bds_tsina">新浪微博</a>
<a class="bds_tqq">腾讯微博</a>
<a class="bds_qzone">QQ空间</a>
<a class="bds_douban">豆瓣网</a>
<a class="bds_renren">人人网</a>
<span class="bds_more">更多分享</span>
</div>
<script type="text/javascript" id="bdshare_js" data="type=tools&amp;uid=642308" ></script>
<script type="text/javascript" id="bdshell_js"></script>
<script type="text/javascript">
var bds_config={'bdText':'我最近在使用译点通专业翻译，人工在线翻译，服务好，快速准确，价格实惠，快来试试吧！','bdPic':'http://www.yeedt.com/weibo_tu.jpg',"snsKey":{'tsina':'2137056766','tqq':'100282790','t163':'','tsohu':''}}
document.getElementById("bdshell_js").src = "http://bdimg.share.baidu.com/static/js/shell_v2.js?cdnversion=" + Math.ceil(new Date()/3600000);
</script>
<!-- Baidu Button END --> 
</td>
    <td></td>
  </tr>
                           </table>
                          </div></div>
</div>
                          <h1>邀请记录</h1>
                        	<!--
                        	<div class="accord-nav">
								<a href="" class="current" data-act="chongzhi-record">充值记录</a>
                                <a href="account03.html" class="clog-js" data-act="koufei-record">扣费记录</a>
							</div>
							-->
<style>
.filters {
  display: none;
}
</style>
 <?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'charge-grid',
	'dataProvider'=>$model->search(),
    'enableSorting'=>false,
    'enablePagination'=>true,
    'summaryText' => '',
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
      'header'=>'邀请时间',
      'type' => 'raw',
      'value'=>'date("Y-m-d", $data->yu["join_date"]) . "<br />" . date("H:i:s", $data->yu["join_date"])',
      'filter'=>false,
    ),
    /*
	array(
		'name'=>'medium',
		'value'=>'Lookup::item("ReferralMediums",$data->medium)',
           'filter'=>false,
    ),
     */
    array(
      'header'=>'状态',
        'type'=>'raw',
        'value'=>'Lookup::item("ConsumerState",$data->yu["consumer_state"])',
        'filter'=>false,
    ),
    array(
      'header'=>'操作',
      'type' => 'raw',
      'value'=>'("consumed" === $data->yu["consumer_state"]) ? (0 == $data->is_rebates ? CHtml::link(CHtml::encode("领取返利"),"javascript:void(0)",array("submit"=>array("user/receiveRebates","referralId"=>$data->id),"confirm"=>"领取返利只有一次机会！")) : CHtml::encode("已领取")) : CHtml::encode("未消费不可领取")',
      'filter'=>false,
    ),
	),
)); ?>
                    	</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<script language="javascript">
function copyToClipboard(theField,isalert)
{
  var obj=document.getElementById(theField);
  if(obj!=null)
  {
      var clipBoardContent=obj.value;
      obj.select();
      window.clipboardData.setData("Text",clipBoardContent);
      if(isalert!=false)
        alert("复制成功。现在您可以粘贴（Ctrl+V）到剪切板中了。");
    }
  else
  {
       alert("Error!");
    }
}
</script>
