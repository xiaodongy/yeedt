<?php
$this->pageTitle=Yii::app()->name . ' - 登录';
$this->breadcrumbs=array(
	'用户登录',
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
                	提示：如果你还不是会员，请先 <?php echo CHtml::link("注册账户",array('/path/reg')); ?>	
				</div>
	    		<div class="top_right"></div>
    		</div>
    	</td></tr>
	</table>

<div id="reg_form">
<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'login-form',
	'enableAjaxValidation'=>false,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>	
		<ul class="main_form">  
			<li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'username'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                            	<?php echo $form->textField($model,'username',array("class"=>"regForm_input")); ?>
                            </span>
                        </td>
                        <td>
					 		
                            <?php echo $form->error($model,'username'); ?>
					    </td></tr>
                     </table>
                     
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
                              <?php echo $form->error($model,'password'); ?>
					    </td></tr>
                     </table>
                    
			</li>
            <li><div class="fm_left"></div>
				<div class="fm_right">
				<div class="rememberMe_i"><?php echo $form->checkBox($model,'rememberMe',array("class"=>"printBillI")); ?></div>
					 
					 
				 <?php echo str_replace("label","div",$form->labelEx($model,'rememberMe',array("class"=>"rememberMe_h"))); ?>
                      <?php echo $form->error($model,'rememberMe'); ?>
                      <?php echo CHtml::link("忘记密码？", array("path/forgetPassword")); ?>
                </div>
                
                
                 </li>
            
            <li class="subArea">
                <?php echo CHtml::button('登录', array('submit' => array('path/login'),"class"=>"clog-js control-btn")); ?>
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
