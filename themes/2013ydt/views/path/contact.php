<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css" rel="stylesheet">
<?php
$this->pageTitle=Yii::app()->name . ' - Contact';
$this->breadcrumbs=array(
	'联系我们',
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
                	您有相关建议和意见也可以通过以下表单留言我们
				</div>				
	    		<div class="top_right"></div>
    		</div>
    	</td></tr>
	</table>
	
<?php
$this->widget('ext.EUserFlash',array(
 'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

<div id="reg_form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'contact-form',
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'validateOnSubmit'=>true,
	),
)); ?>
		<ul class="main_form">  

			<li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'name'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                            	<?php echo $form->textField($model,'name',array("class"=>"regForm_input")); ?>
                            </span>
                        </td>
                        <td>
					 		
                            <?php echo $form->error($model,'name'); ?>
                   
					    </td></tr>
                    </table>
                     
				</div>
			</li>
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
                     
				</div>
			</li>
            <li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'phone'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                            	  <?php echo $form->textField($model,'phone',array("class"=>"regForm_input")); ?>
                            </span>
                        </td>
                        <td>
					 		
                              <?php echo $form->error($model,'phone'); ?>
                 
					    </td></tr>
                    </table>
                     
				</div>
			</li>

            <li>
 				<div class="fm_left"><?php echo $form->labelEx($model,'body'); ?></div>
				<div class="fm_right">
                	<table>
                    	<tr><td>
                        	<span class="suggest_box">
                            	  <?php echo $form->textArea($model,'body',array("class"=>"regForm_txt","size"=>"60","maxlength"=>"128")); ?>
                            </span>
                        </td>
                        <td>
					 		
                              <?php echo $form->error($model,'body'); ?>
                 
					    </td></tr>
                    </table>
                     
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
                <?php echo CHtml::button('提交留言', array('submit' => array('path/reg'),"class"=>"clog-js control-btn")); ?>
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