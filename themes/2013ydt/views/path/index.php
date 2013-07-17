<?php
$this->pageTitle=Yii::app()->name . ' - 专业快速人工翻译服务';
$this->breadcrumbs=array(
	'首页',
);
?>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery-1.4.4.min.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/jquery.featureList-1.0.0.js"></script>
<script type="text/javascript" src="<?php echo Yii::app()->theme->baseUrl; ?>/js/gundong.js"></script>
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/index.css" />
<script language="javascript">
		$(document).ready(function() {

			$.featureList(
				$("#tabs li a"),
				$("#output li"), {
					start_item	:	1
				}
			);

			/*
			
			// Alternative

			
			$('#tabs li a').featureList({
				output			:	'#output li',
				start_item		:	1
			});

			*/

		});
</script>

    <div id="bd" class="index">
        <div id="trans-introduction">
            <div id="tx_content">
              <div id="feature_list">
                <ul id="tabs">
                  <li> <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/css/default/images/Clock.png") . '<h3>快速翻译</h3><span>在线快速人工翻译服务</span>',array('path/fast'),array('style'=>'cursor: pointer')); ?> </li>
                  <li> <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/css/default/images/Document.png") . '<h3>文档翻译</h3><span>多领域专业精准人工翻译服务</span>',array('path/file'),array('style'=>'cursor: pointer')); ?> </li>
                  <li> <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/css/default/images/Window Move.png") . '<h3>网站翻译</h3><span>首创嵌入式翻译服务 一键翻译网站内容</span>',array('path/webSite'),array('style'=>'cursor: pointer')); ?> </li>
                </ul>
                <ul id="output">
                  <li> <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/css/default/images/1.jpg",'亚洲七强在线快速人工翻译',array("width"=>"621","height"=>"320")),array('path/fast'),array('title'=>'亚洲七强在线快速人工翻译')); ?> </li>
                  <li> <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/css/default/images/2.jpg",'多领域专业精准人工翻译服务',array("width"=>"621","height"=>"320")),array('path/file'),array('title'=>'多领域专业精准人工翻译服务')); ?> </li>
                  <li> <?php echo CHtml::link(CHtml::image(Yii::app()->theme->baseUrl . "/css/default/images/3.jpg",'嵌入式插件网站翻译服务',array("width"=>"621","height"=>"320")),array('path/webSite'),array('title'=>'嵌入式插件网站翻译服务')); ?> </li>
                </ul>
              </div>
            </div>
        </div>
        <div class="tab">
       	  <div class="tab-sec0">
          	<div class="menu">
                <div class="menu-007"></div>
            	</div>
            	<div class="tab-sec1">
                <ul>
                    <li class="notice"><?php echo CHtml::link("1、译点通提供哪些翻译服务？",array('path/about'),array('target'=>'_blank')); ?></li>
                    <li class="notice"><?php echo CHtml::link("2、译点通专业翻译服务如何收费？",array('path/about',"#"=>"doc-file"),array('target'=>'_blank')); ?></li>
                    <li class="notice"><?php echo CHtml::link("3、质量保障，保密机制，售后服务",array('path/about',"#"=>"doc-zhiliang"),array('target'=>'_blank')); ?></li>
                </ul>
            	</div>
          </div>

	      <div class="tab-sec2">
                <div class="menu">
                <div class="menu-contact"></div>
                <a href="http://blog.yeedt.com/" target="_blank" title="更多">More..</a>
            	</div>
            	<div class="tab-sec1">
                <ul>  <li class="event"><a href="http://blog.yeedt.com/post-31.html" target="_blank">为何要使用译点通专业翻译，有哪些优势？</a></li>
                    <li class="event"><a href="http://blog.yeedt.com/post-35.html" target="_blank">哪些情况下需要使用译点通快速翻译</a></li>
                    <li class="event">公告：<a href="http://blog.yeedt.com/post-38.html" target="_blank">《译点通翻译新春下单即送8G精美u盘》</a></li>
                </ul>
            	</div>
            </div>

            <div class="tab-sec2">
                <div class="menu">
                    <div class="menu-concerns"></div>
                </div>
                <div class="tab-contact contact-only">
                <div class="tel-logo"></div>
                    <div class="tab-menu-suggestion">
                        <span class="contact-tel">
                            <span class="contact-title">免费咨询电话</span><br>
                            <span class="contact-num">400-050607-1</span><!-- 在线客服图标:在线咨询[文字型] 开始-->
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="cooperator">
        	<h1><a href="http://blog.yeedt.com/post-36.html" target="_blank">More..</a></h1>
            
             <div class="marquee hz_logo" direction="left" speed="20" step="1" pause="1">
      <ul style="width: 14700px">
<li>
<a><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz1.png"></a> </li>         <li><a><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz2.png"></a> </li>          <li><a><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz3.png"></a>  </li>       <li><a> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz4.png"></a></li>          <li> <a><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz5.png"></a> </li>          <li><a><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz6.png"></a>  </li>         <li><a> <img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz7.png"></a></li>           <li><a href="http://www.edusjw.com/" target="_blank"><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz8.png" alt="网站建设"></a></li> 
<li><a><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/hz9.png" alt="筑巢数字"></a></li> 
</ul></div>


        </div>
    </div><!---bd end--->
