<?php
$this->pageTitle=Yii::app()->name . ' - 找回密码';
$this->breadcrumbs=array(
	'用户找回密码',
);
?>
<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css" rel="stylesheet">

    <div id="bd" class="support-des others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">

               <!--主体 开始-->
                    <div class="main1">
	<table border="0" align="center" cellpadding="0" cellspacing="0">
		<tr><td>
			<div class="top_text" style="padding:0;margin-top:30px">
				<div class="top_left"></div>
				<div class="top_middle warn_icon">
                    提示：如果你已经记起密码，请先直接 <?php echo CHtml::link("登录",array('/path/login')); ?>
				</div>
	    		<div class="top_right"></div>
    		</div>
    	</td></tr>
	</table>

		<ul class="main_form">  
            <li>
                <h1 style="color: #b93b70;">密码重置邮件已发送</h1>
            </li>
            <li>
                <h3>我们已经发送密码重置邮件到您的注册邮箱，请在24小时内点击邮件中的链接重置您的密码。</h3>
            </li>
        </ul>
            <!--主体 结束-->
                    </div>
                </div>
            </div>
        </div>
    </div>
