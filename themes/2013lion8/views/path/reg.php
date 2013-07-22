<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css" rel="stylesheet">
<?php
$this->pageTitle=Yii::app()->name . ' - 注册';
$this->breadcrumbs=array(
	'用户注册',
);
?>

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
                	提示：如果你已经是注册会员，请直接 <?php echo CHtml::link("登录",array('/path/login')); ?>	
				</div>
	    		<div class="top_right"></div>
    		</div>
    	</td></tr>
	</table>

<div id="reg_form">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'reg-form-reg-form',
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
					 		<span class="err_info">
                            <?php echo $form->error($model,'email'); ?>
                     </span>
					    </td></tr>
                     </table>
                     <div class="f_s_12 clear">
                     	<div class="f_s_12 c_8A8A8A clear" id="email_name_r_info">输入一个你已拥有的邮件地址，以通过验证完成注册。邮箱就是通行证，可以直接登录。</div>
					</div>
				</div>
			</li>
<li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'password'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                              <?php echo $form->passwordField($model,'password',array("class"=>"regForm_input")); ?>
                            </span>
                        </td>
                        <td>
					 		<span class="err_info">
                           <?php echo $form->error($model,'password'); ?>
                     </span>
					    </td></tr>
                     </table>
                     <div class="f_s_12 clear">
                     	<div class="f_s_12 c_8A8A8A clear" id="email_name_r_info">6到16个字符，区分大小写。</div>
					</div>
				</div>
			</li>
<li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'re_password'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                             <?php echo $form->passwordField($model,'re_password',array("class"=>"regForm_input")); ?>
                            </span>
                        </td>
                        <td>
					 		<span class="err_info">
                           <?php echo $form->error($model,'re_password'); ?>
                     </span>
					    </td></tr>
                     </table>
                     <div class="f_s_12 clear">
                              <div class="f_s_12 c_8A8A8A clear" id="re_password_info">再次输入你设置的密码。</div>
					</div>
				</div>
			</li>

        <?php if(CCaptcha::checkRequirements()): ?>     
   <li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'verifyCode'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td><span class="suggest_box"><?php echo $form->textField($model,'verifyCode',array("class"=>"regForm_input","maxlength"=>"5")); ?></span>
                        </td>
                        <td>
					 		<span class="err_info">
                          <?php echo $form->error($model,'verifyCode'); ?>
                     </span>
					    </td></tr>
                    	<tr>
                    	  <td><?php $this->widget('CCaptcha',array('showRefreshButton'=>false,'clickableImage'=>true)); ?></td>
                    	  <td>&nbsp;</td>
                  	  </tr>
                     </table>
                     <div class="f_s_12 clear">
                            <div class="f_s_12 c_8A8A8A clear" id="usercheckcode_info">不区分大小写。看不清楚可以点击图片换一个。</div>
					</div>
				</div>
			</li>
              <?php endif; ?>
              <li class="subArea">
                <?php echo CHtml::button('注册', array('submit' => array('path/reg'),"class"=>"clog-js control-btn")); ?>
            </li>

                <li>
             		 <div class="fm_left">&nbsp;</div>
                     <span class="read-agreement">
                <input id="alreadyRead" type="checkbox" checked=""><label for="alreadyRead" style="font-size:12px; line-height:100%;">我已阅读并同意<?php echo CHtml::link("《译点通专业翻译服务条款》",array("/path/server"),array("target"=>"_blank","rel"=>"nofollow")); ?>
                </label>
            </span>
                </li>
          </ul>

		


<?php $this->endWidget(); ?>
</div><!-- form -->
 
</div>
           <!--主体 结束-->
                    </div>
                </div>
            </div>
        </div>
    </div>


<script type="text/javascript" language="javascript">
function showInvoice() {
    if(document.getElementById("file-form-file-form").is_invoice.checked == true) {
        document.getElementById("FileForm_is_invoice").style.display = "";
    } else {
        document.getElementById("FileForm_is_invoice").style.display = "none";
    }
}
</script>
