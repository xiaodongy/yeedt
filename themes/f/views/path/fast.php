<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fast-form-fast-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

	<p class="note">（<span class="required">*</span>为必填）</p>

	<div class="row">
		<?php echo $form->labelEx($model,'language'); ?>：&nbsp;&nbsp;
		<?php echo $form->dropDownList($model,'language', Lookup::items('TranslateLanguages'), array('prompt'=>'自动检测语言')); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'original'); ?>：
		<?php echo $form->error($model,'original'); ?>
        <?php echo $form->textArea($model,'original',array('rows'=>6, 'cols'=>100, 'placeholder'=>'目前仅支持中英互译。且不支持起名、古文、诗歌、菜单等创意性翻译，请勿在此提交。详情请查看服务说明或咨询客服。')); ?>
    </div>
    <p class="count-textArea">
        <a href="javascript:void(0)" onclick="format_content(4);">清空内容</a>
        <span id="result">
            字数统计：<b>0</b>&nbsp;&nbsp;&nbsp;&nbsp;
            预计耗时：<b>0</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;
            价格：<b>0</b>元
        </span>
    </p>

	<div class="row">
		<?php echo $form->labelEx($model,'demand'); ?>：&nbsp;&nbsp;
		<?php echo $form->textField($model,'demand', array('size'=>56, 'placeholder'=>'如翻译领域、用途、专业词汇等相关说明')); ?>
		<?php echo $form->error($model,'demand'); ?>
    </div>

<?php if(Yii::app()->user->isGuest || empty(Yii::app()->user->phone)): ?>
	<div class="row">
		<?php echo $form->labelEx($model,'phone'); ?>：
		<?php echo $form->textField($model,'phone', array('size'=>25, 'placeholder'=>'可获得免费翻译状态短信提醒')); ?>
		<?php echo $form->error($model,'phone'); ?>
    </div>
<?php endif; ?>

<!--
	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email'); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'word_count'); ?>
		<?php echo $form->textField($model,'word_count'); ?>
		<?php echo $form->error($model,'word_count'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'is_invoice'); ?>
		<?php echo $form->textField($model,'is_invoice'); ?>
		<?php echo $form->error($model,'is_invoice'); ?>
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
		<?php echo $form->labelEx($model,'document'); ?>
		<?php echo $form->textField($model,'document'); ?>
		<?php echo $form->error($model,'document'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'name'); ?>
		<?php echo $form->textField($model,'name'); ?>
		<?php echo $form->error($model,'name'); ?>
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
		<?php echo $form->labelEx($model,'qq'); ?>
		<?php echo $form->textField($model,'qq'); ?>
		<?php echo $form->error($model,'qq'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'translation'); ?>
		<?php echo $form->textField($model,'translation'); ?>
		<?php echo $form->error($model,'translation'); ?>
	</div>
-->

	<div class="row buttons">
		<?php echo CHtml::submitButton('提交翻译'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->

<script>function format_content(a){var b=document.getElementById("FastForm_original");if(!b){return}if(a==1){b.value=b.value.replace(/^\s+|\s+$/g,"")}else{if(a==2){b.value=b.value.replace(/[\s]/g,"")}else{if(a==3){b.value=b.value.replace(/[\r\n]/g,"")}else{if(a==4){b.value="";document.getElementById("result").innerHTML="字数统计：<b>0</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>0</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>0</b>元";return}}}}b.focus()};</script>

<script>(function(){function a(k){var m=document.getElementById("FastForm_original");if(m.value==""){document.getElementById("result").innerHTML="字数统计：<b>0</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>0</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>0</b>元";return}var j=m.value;var g=m.value.replace(/\r\n/g,"\n");var e=g.length;var d={wd:0,enwords:0,totals:0,cb:0,lines:0,en:0,cn:0,blank:0,marks:0};var n=g.match(/\b\w+\b/g)||[];var f=g.match(/[\u4E00-\u9FA5\uF900-\uFA2D]/g)||[];d.enwords=n.length;d.cn=f.length;for(var h=0;h<e;h++){var p=g.charAt(h);d.totals++;var o=/[\`\~\,\.\!\@\#\$\%\^\&\*\(\)\-\_\+\=\{\}\[\]\:\;\"\'\<\>\/\?\\\\|。，、；：？！…—·ˉ¨‘’“”～々‖∶＂＇｀｜〃〔〕〈〉《》「」『』．〖〗【】（）［］｛｝]/g;if(o.test(p)){d.marks++}switch(true){case /[a-zA-Z]/.test(p):d.en++;break;case /\S/.test(p):d.cb++;break;case /\s/.test(p):if(p=="\n"||p=="\r"){d.lines++}else{d.blank++}break}}d.wd=d.enwords+d.cn;var l="";l+="<span>";l+="字数统计：<b>"+d.wd+"</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>"+Math.ceil(d.wd/10)+((d.wd > 10) ? "~" + ((Math.ceil(d.wd/10))+3) : '')+"</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>"+Math.round(d.wd*0.29*100)/100+"</b>元";l+="</span>";l+='<input value="'+d.wd+'" name="FastForm[word_count]" id="FastForm_word_count" type="hidden" />';l+='<input value="'+Math.round(d.wd*0.29*100)/100+'" name="FastForm[price]" id="FastForm_price" type="hidden" />';document.getElementById("result").innerHTML=l}function b(){var d=document.getElementById("FastForm_original");if(d.attachEvent){d.attachEvent("onpropertychange",function(){a(true)})}else{d.addEventListener("input",function(){a(true)},false)}}if(document.getElementById("FastForm_original")){b()}else{window.onload=function(){b()}}})();</script>
