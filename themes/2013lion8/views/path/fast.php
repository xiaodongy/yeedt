<?php
$this->pageTitle=Yii::app()->name . ' - 人工快速翻译';
$this->breadcrumbs=array(
	'快速翻译',
);
?>
<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/trans.css" rel="stylesheet">
<script>function format_content(a){var b=document.getElementById("FastForm_original");if(!b){return}if(a==1){b.value=b.value.replace(/^\s+|\s+$/g,"")}else{if(a==2){b.value=b.value.replace(/[\s]/g,"")}else{if(a==3){b.value=b.value.replace(/[\r\n]/g,"")}else{if(a==4){b.value="";document.getElementById("result").innerHTML="字数统计：<b>0</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>0</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>0</b>元";return}}}}b.focus()};</script>

<script>(function(){function a(k){var m=document.getElementById("FastForm_original");if(m.value==""){document.getElementById("result").innerHTML="字数统计：<b>0</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>0</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>0</b>元";return}var j=m.value;var g=m.value.replace(/\r\n/g,"\n");var e=g.length;var d={wd:0,enwords:0,totals:0,cb:0,lines:0,en:0,cn:0,blank:0,marks:0};var n=g.match(/\b\w+\b/g)||[];var f=g.match(/[\u4E00-\u9FA5\uF900-\uFA2D]/g)||[];d.enwords=n.length;d.cn=f.length;for(var h=0;h<e;h++){var p=g.charAt(h);d.totals++;var o=/[\`\~\,\.\!\@\#\$\%\^\&\*\(\)\-\_\+\=\{\}\[\]\:\;\"\'\<\>\/\?\\\\|。，、；：？！…—·ˉ¨‘’“”～々‖∶＂＇｀｜〃〔〕〈〉《》「」『』．〖〗【】（）［］｛｝]/g;if(o.test(p)){d.marks++}switch(true){case /[a-zA-Z]/.test(p):d.en++;break;case /\S/.test(p):d.cb++;break;case /\s/.test(p):if(p=="\n"||p=="\r"){d.lines++}else{d.blank++}break}}d.wd=d.enwords+d.cn;var l="";l+="<span>";l+="字数统计：<b>"+d.wd+"</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>"+Math.ceil(d.wd/10)+((d.wd > 10) ? "~" + ((Math.ceil(d.wd/10))+3) : '')+"</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>"+Math.round(d.wd*<?php echo Yii::app()->params['priceForFast']; ?>*100)/100+"</b>元";l+="</span>";l+='<input value="'+d.wd+'" name="FastForm[word_count]" id="FastForm_word_count" type="hidden" />';l+='<input value="'+Math.round(d.wd*<?php echo Yii::app()->params['priceForFast']; ?>*100)/100+'" name="FastForm[price]" id="FastForm_price" type="hidden" />';document.getElementById("result").innerHTML=l}function b(){var d=document.getElementById("FastForm_original");if(d.attachEvent){d.attachEvent("onpropertychange",function(){a(true)})}else{d.addEventListener("input",function(){a(true)},false)}}if(document.getElementById("FastForm_original")){b()}else{window.onload=function(){b()}}})();</script>

	<div id="bd" class="trans">
		<div class="tab">
			<?php echo CHtml::link("快速翻译",array('/path/fast'),array("class"=>"fast-trans current","title"=>"快速翻译","rel"=>"nofollow")); ?>
			<?php echo CHtml::link("文档翻译",array('/path/file'),array("class"=>"doc-trans","title"=>"文档翻译","rel"=>"nofollow")); ?>
            <?php echo CHtml::link("为何使用快速翻译",array('/path/about',"#"=>"doc-fast"),array("class"=>"message-tip","rel"=>"nofollow","target"=>"_blank")); ?>
        </div>

<div class="form">
<div class="content quick-trans">
<?php
$this->widget('ext.EUserFlash',array(
    'initScript'=>"$('.userflash_success').fadeOut(5000);$('.userflash_notice').fadeOut(5000);"
));
?>

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'fast-form-fast-form',
	'enableAjaxValidation'=>true,
    'enableClientValidation'=>true,
	'clientOptions'=>array(
        'validateOnSubmit'=>true,
    ),
)); ?>
            <div class="form-item-layout first-margin-fix first-margin-fix-left">
                <?php echo $form->labelEx($model,'language',array("for"=>"language")); ?>
                <?php echo $form->dropDownList($model,'language', Lookup::items('FastTranslateLanguages'), array('prompt'=>'自动检测语言',"class"=>"first-margin-fix")); ?>
                <?php echo str_replace("div","i",$form->error($model,'original',array("class"=>"trans-error-message"))); ?>
            </div>

            <div class="row">
                <?php echo $form->labelEx($model,'original',array("for"=>"inputText")); ?>
                <?php echo $form->textArea($model,'original',array('rows'=>6, 'cols'=>100, 'placeholder'=>'目前仅支持中英互译。且不支持起名、古文、诗歌、菜单等创意性翻译，请勿在此提交。详情请查看服务说明或咨询客服。',"class"=>"form-item-layout input-text")); ?>
			</div>
			<div class="trans-info form-item-layout">
                <a class="clear-content" data-act="clear" rel="nofollow" href="javascript:void(0)" onclick="format_content(4);">清空内容</a>
                <span id="result">
                    字数统计：<b>0</b>&nbsp;&nbsp;&nbsp;&nbsp;预计耗时：<b>0</b>分钟&nbsp;&nbsp;&nbsp;&nbsp;价格：<b>0</b>元
                </span>
			</div>

            <div class="demand-note">
                <?php echo $form->labelEx($model,'demand',array("for"=>"demandNote")); ?>
                <?php echo $form->textArea($model,'demand', array('rows'=>1, 'placeholder'=>'如翻译领域、用途、专业词汇等相关说明')); ?>
                <?php echo str_replace("div","i",$form->error($model,'demand',array("class"=>"demand-error-message"))); ?>
            </div>

<?php if(Yii::app()->user->isGuest || empty($model->phone)): ?>
            <div class="user-phone">
                <?php echo $form->labelEx($model,'phone',array("for"=>"inputText")); ?>
                <div class="form-item-layout">
                    <?php echo $form->textField($model,'phone', array('size'=>32, 'placeholder'=>'可获得免费翻译状态短信提醒')); ?>
		            <?php echo str_replace("div","span",$form->error($model,'phone',array("class"=>"error-tel"))); ?>
                </div>
            </div>
<?php endif; ?>

            <?php
            if($orderId)
                echo CHtml::button('提交翻译', array('submit' => array('path/fast','orderId'=>$orderId),"class"=>"form-item-layout control-btn form-item-submit"));
            else
                echo CHtml::button('提交翻译', array('submit' => array('path/fast'),"class"=>"form-item-layout control-btn form-item-submit"));
            ?>
            
            <span class="read-agreement">
                <input id="alreadyRead" type="checkbox" checked=""><label for="alreadyRead">我已阅读并同意<?php echo CHtml::link("《译点通专业翻译服务条款》",array("/path/server"),array("target"=>"_blank","rel"=>"nofollow")); ?>
                </label>
            </span>

<?php $this->endWidget(); ?>
</div>
</div><!-- form -->

        <div id="trans-history">
            <h3 class="history-title">
                <?php echo CHtml::link("查看更多",array("user/translateResult"),array("class"=>"see-more")); ?> 翻译记录
            </h3>
            <div id="trans-history-list">
<?php
if(!Yii::app()->user->isGuest) {
	$this->widget('zii.widgets.CListView', array(
		'dataProvider'=>$translateResult,
		'summaryText'=>'',
        'emptyText'=>'',
		'itemView'=>'_viewTranslateResult',
	));
	echo "</div>";
	if(5 < $translateResult->getItemCount())
		echo '<h3 class="history-title">' . CHtml::link("查看更多",array("user/translateResult"),array("class"=>"see-more")) . '翻译记录</h3>';
}
?>
        </div>
    </div>

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
