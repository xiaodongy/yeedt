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

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'forget-password-forgetPassword-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>



		<ul class="main_form">  
			<li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'email'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                            	<?php echo $form->textField($model,'email',array("class"=>"regForm_input")); ?>
                            </span>
                        </td>
                        <td>
                            <?php echo $form->error($model,'email'); ?>
					    </td></tr>
                     </table>
                     <div class="f_s_12 clear">
                     	<div class="f_s_12 c_8A8A8A clear" id="email_name_r_info">输入您的注册邮箱地址，获取密码重置邮件，根据邮件中指引重置密码。</div>
					</div>
				</div>
			</li>

            <li class="subArea">
                <?php echo CHtml::button('重置密码', array('submit' => array('path/forgetPassword'),"class"=>"clog-js control-btn")); ?>
            </li>
        </ul>

<?php $this->endWidget(); ?>

</div><!-- form -->
            <!--主体 结束-->
                    </div>
                </div>
            </div>
        </div>
    </div>
