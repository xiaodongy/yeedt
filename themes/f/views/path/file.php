<div class="form">

<?php
$user = Yii::app()->user;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'file-form-file-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note">（<span class="required">*</span>为必填）</p>

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>：
		<?php echo $form->dropDownList($model,'language', Lookup::items('TranslateLanguages'), array('prompt'=>'请选择')); ?>
		<?php echo $form->error($model,'language'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'document'); ?><span class="required">*</span>：
		<?php echo $form->fileField($model,'document'); ?>
		<?php echo $form->error($model,'document', array('class'=>'error-document')); ?>
		<p class="hint">
            请上传<tt>doc、docx、txt、pdf、rar、zip</tt>格式的文件。<br />
            如有多个文件，请打包后上传，上传文件大小不能超过<tt>20M</tt>。
		</p>
    </div>

	<div class="row">
		<?php echo $form->labelEx($model,'demand', array('class'=>'form-demand')); ?>：<br />
		<?php echo $form->textArea($model,'demand',array('rows'=>8, 'cols'=>40)); ?>
		<p class="hint">
            （如您对交稿时间，更多翻译语种等方面的要求）
		</p>
		<?php echo $form->error($model,'demand'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>&nbsp;&nbsp;：
        <?php
        if (isset($user->name) and 'Guest' !== $user->name)
            echo $form->textField($model,'name',array('value'=>$user->name));
        else
            echo $form->textField($model,'name');
        ?>
		<?php echo $form->error($model,'name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>：
        <?php
        if (isset($user->phone))
            echo $form->textField($model,'phone',array('value'=>$user->phone));
        else
            echo $form->textField($model,'phone');
        ?>
		<?php echo $form->error($model,'phone'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>：
        <?php
        if (isset($user->email))
            echo $form->textField($model,'email',array('value'=>$user->receive_email));
        else
            echo $form->textField($model,'email');
        ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'qq'); ?>&nbsp;&nbsp;：
        <?php
        if (isset($user->qq))
            echo $form->textField($model,'qq',array('value'=>$user->qq));
        else
            echo $form->textField($model,'qq');
        ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

    <div class="row">
        <input type="checkbox" id="is_invoice" name="is_invoice" onclick="showInvoice()" />
		<?php echo $form->labelEx($model,'is_invoice'); ?>
        <?php echo $form->textField($model,'is_invoice', array('placeholder'=>'抬头，如公司名称等', 'style'=>'display: none;')); ?>
		<?php echo $form->error($model,'is_invoice'); ?>
	</div>

<!--
	<div class="row">
		<?php echo $form->labelEx($model,'word_count'); ?>
		<?php echo $form->textField($model,'word_count'); ?>
		<?php echo $form->error($model,'word_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'create_time'); ?>
		<?php echo $form->textField($model,'create_time'); ?>
		<?php echo $form->error($model,'create_time'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'type'); ?>
		<?php echo $form->textField($model,'type'); ?>
		<?php echo $form->error($model,'type'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status'); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'price'); ?>
		<?php echo $form->textField($model,'price'); ?>
		<?php echo $form->error($model,'price'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original'); ?>
		<?php echo $form->textField($model,'original'); ?>
		<?php echo $form->error($model,'original'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textField($model,'translation'); ?>
		<?php echo $form->error($model,'translation'); ?>
	</div>
-->

		<p class="hint">
            （务必填写联系方式，实际价格将电话确认，您所填信息我们会严格保密）
		</p>

	<div class="row buttons">
		<?php echo CHtml::submitButton('提交翻译'); ?>
	</div>
<div style="float: left;">

</div>
<?php $this->endWidget(); ?>

</div><!-- form -->

<script type="text/javascript" language="javascript">
function showInvoice() {
    if(document.getElementById("file-form-file-form").is_invoice.checked == true) {
        document.getElementById("FileForm_is_invoice").style.display = "";
    } else {
        document.getElementById("FileForm_is_invoice").style.display = "none";
    }
}
</script>