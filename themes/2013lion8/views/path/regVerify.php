<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css" rel="stylesheet">
<?php
$this->pageTitle=Yii::app()->name . ' - Regverify';
$this->breadcrumbs=array(
	'邮件验证',
);
?>

    <div id="bd" class="support-des others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
                        
                      
                      
               <!--主体 开始-->       
                      
                  <div class="main1">
    	<div class="top_text">
        	<div class="mail_img"></div>
            <div class="r_text2">
            <p><b>验证邮件已发出，请48小时内登录邮箱验证。</b></p>
            <p class="f_s_14">登录邮箱 <b class="c_32A200">
                <?php echo $email; ?></b> 并按邮件指示操作即可</p>
            
            </div>
        </div>
        <div class="seperate"></div>
        <div class="info">
        	<p class="f_s_14"><b>还没有收到验证邮件？</b></p>
            <p>1.尝试到广告邮件、垃圾邮件目录里找找看</p>
            <p>2.<a href="javascript:void(0)" onclick="javascript:sendMail();">再次发送验证邮件</a></p>
            <p>3.如果重发注册验证邮件仍然没有收到，请<?php echo CHtml::link('更换另一个邮件地址',array('/path/reg'),array("target"=>"_self")); ?></p>
        </div>
 	
</div>
                      
                      
            <!--主体 结束-->          
                      
                      
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>