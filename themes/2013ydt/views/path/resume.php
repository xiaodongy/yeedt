<?php
$this->pageTitle=Yii::app()->name . ' - 简历翻译';
$this->breadcrumbs=array(
	'简历翻译',
);
?>
<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/trans.css" rel="stylesheet">
    <div id="bd" class="trans">
        <div class="tab">
         <?php echo CHtml::link("快速翻译",array('/path/fast'),array("class"=>"fast-trans","title"=>"快速翻译","rel"=>"nofollow")); ?>
             <?php echo CHtml::link("文档翻译",array('/path/file'),array("class"=>"fast-trans","title"=>"文档翻译","rel"=>"nofollow")); ?>
			<?php echo CHtml::link("简历翻译",array('/path/resume'),array("class"=>"doc-trans current","title"=>"网站翻译","rel"=>"nofollow")); ?>
			<?php echo CHtml::link("收费标准",array('/path/about',"#"=>"doc-website"),array("class"=>"message-tip","rel"=>"nofollow", "target"=>"_blank","title"=>"点击查看")); ?>
        </div>

<div class="form">
<div class="content doc-trans">

<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>


<?php
$user = Yii::app()->user;
$form=$this->beginWidget('CActiveForm', array(
	'id'=>'resume-form-resume-form',
    'enableAjaxValidation'=>false,
    'htmlOptions' => array('enctype' => 'multipart/form-data'),
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>

            <div class="user-info">
            	<span class="title">个人信息（<i class="important">*</i> 为必填项） 
                <!--	<a class="save-to-contact flog-js" data-act="save-contact" href="">[保存到联系方式]</a>-->
                </span>

                <?php echo $form->labelEx($model,'name',array("for"=>"userNameI")); ?>
                <div class="form-item-layout">
                    <?php echo $form->textField($model,'name'); ?>
                    <?php echo str_replace("div","i",$form->error($model,'name')); ?>
                </div>
                <?php echo $form->labelEx($model,'phone',array("for"=>"userPhoneI")); ?>
                <div class="form-item-layout">
                    <?php echo $form->textField($model,'phone',array("placeholder"=>"用于报价，固话请填写区号")); ?>
                    <?php echo str_replace("div","i",$form->error($model,'phone')); ?>
                </div>
                <?php echo $form->labelEx($model,'email',array("for"=>"userEmailI")); ?>
                <div class="form-item-layout">
                    <?php echo $form->textField($model,'email',array("placeholder"=>"用于接收翻译结果")); ?>
                    <?php echo str_replace("div","i",$form->error($model,'email')); ?>
                </div>
                <?php echo $form->labelEx($model,'qq',array("for"=>"userQQI")); ?>
                <div class="form-item-layout">
                    <?php echo $form->textField($model,'qq'); ?>
                    <?php echo str_replace("div","i",$form->error($model,'qq')); ?>
                </div>
<!--
                <label for="userBillI">
                    <input type="checkbox" class="printBillI" id="is_invoice" name="is_invoice" onclick="showInvoice()" />
                    <?php echo str_replace("label","span",$form->labelEx($model,'is_invoice',array("style"=>"font-weight: normal;"))); ?>
                </label>
                <div class="form-item-layout">
                <?php echo $form->textField($model,'is_invoice', array('placeholder'=>'抬头，如公司名称等', 'style'=>'display: none;')); ?>
                </div>
-->
                <div class="form-item-layout"><input id="userBillI" name="billInfo" value="" style="display:none;"></div>
            </div>
            <div class="file-info">
                <?php echo $form->labelEx($model,'language',array("for"=>"language")); ?> 
                <div class="form-item-layout first-margin-fix error-fix">
                    <?php echo $form->dropDownList($model,'language', Lookup::items('FileTranslateLanguages'), array('prompt'=>'请选择',"class"=>"flog-js")); ?>
                    <?php echo str_replace("div","i",$form->error($model,'language',array("class"=>"demand-error-message"))); ?>
                </div>
                <?php echo $form->labelEx($model,'document',array("for"=>"fileInfo")); ?>
                <div class="form-item-layout error-fix">
                    <?php echo $form->fileField($model,'document',array("class"=>"input-file flog-js")); ?>
                    <?php echo str_replace("div","i",$form->error($model,'document',array("class"=>"demand-error-message"))); ?>
                </div>
                <span class="form-item-layout additional">仅支持doc、docx格式的文件。
                    <br>如有多个文件，请打包后上传，上传文件大小不能超过20M。</span>
                <?php echo $form->labelEx($model,'demand', array('for'=>'otherRequirement')); ?>
                <?php echo $form->textArea($model,'demand',array("class"=>"form-item-layout input-text")); ?>
            </div>
            <div class="form-item-layout additional">
                <div class="clear"></div>
                <div class="left" id="intro-left">（如您对交稿时间，更多翻译语种等方面的要求）</div>
                <div class="left" id="intro-right">（务必填写联系方式，实际价格将电话确认，您所填信息我们会严格保密）</div>
                <div class="clear"></div>
            </div>
            <?php echo CHtml::button('提交翻译', array('submit' => array('path/resume'),"class"=>"form-item-layout control-btn flog-js")); ?>
            <span class="read-agreement">
                <input id="alreadyRead" type="checkbox" checked="true"><label for="alreadyRead">我已阅读并同意<?php echo CHtml::link("《译点通专业翻译服务条款》",array("/path/server"),array("target"=>"_blank","rel"=>"nofollow")); ?>
                </label>
            </span>
    </div>
<?php $this->endWidget(); ?>
</div>
</div><!-- form -->

<script type="text/javascript" language="javascript">
function showInvoice() {
    if(document.getElementById("resume-form-resume-form").is_invoice.checked == true) {
        document.getElementById("ResumeForm_is_invoice").style.display = "";
    } else {
        document.getElementById("ResumeForm_is_invoice").style.display = "none";
    }
}
</script>

<style>
    span.emptyhint {color:#999;position:absolute;padding:3px;}
</style>
<script>
function initPlaceHolders(){
    if('placeholder' in document.createElement('input')){ //如果浏览器原生支持placeholder
        return ;
    }
    function target (e){
        var e=e||window.event;
        return e.target||e.srcElement;
    };
    function _getEmptyHintEl(el){
        var hintEl=el.hintEl;
        return hintEl && g(hintEl);
    };
    function blurFn(e){
        var el=target(e);
        if(!el || el.tagName !='INPUT' && el.tagName !='TEXTAREA') return;//IE下，onfocusin会在div等元素触发 
        var    emptyHintEl=el.__emptyHintEl;
        if(emptyHintEl){
            //clearTimeout(el.__placeholderTimer||0);
            //el.__placeholderTimer=setTimeout(function(){//在360浏览器下，autocomplete会先blur再change
                if(el.value) emptyHintEl.style.display='none';
                else emptyHintEl.style.display='';
            //},600);
        }
    };
    function focusFn(e){
        var el=target(e);
        if(!el || el.tagName !='INPUT' && el.tagName !='TEXTAREA') return;//IE下，onfocusin会在div等元素触发 
        var emptyHintEl=el.__emptyHintEl;
        if(emptyHintEl){
            //clearTimeout(el.__placeholderTimer||0);
            emptyHintEl.style.display='none';
        }
    };
    if(document.addEventListener){//ie
        document.addEventListener('focus',focusFn, true);
        document.addEventListener('blur', blurFn, true);
    }
    else{
        document.attachEvent('onfocusin',focusFn);
        document.attachEvent('onfocusout',blurFn);
    }

    var elss=[document.getElementsByTagName('input'),document.getElementsByTagName('textarea')];
    for(var n=0;n<2;n++){
        var els=elss[n];
        for(var i =0;i<els.length;i++){
            var el=els[i];
            var placeholder=el.getAttribute('placeholder'),
                emptyHintEl=el.__emptyHintEl;
            if(placeholder && !emptyHintEl){
                emptyHintEl=document.createElement('span');
                emptyHintEl.innerHTML=placeholder;
                emptyHintEl.className='emptyhint';
                emptyHintEl.onclick=function (el){return function(){try{el.focus();}catch(ex){}}}(el);
                if(el.value) emptyHintEl.style.display='none';
                el.parentNode.insertBefore(emptyHintEl,el);
                el.__emptyHintEl=emptyHintEl;
            }
        }
    }
}

initPlaceHolders();
</script>
