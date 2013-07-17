<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/example.css" rel="stylesheet">
<?php
$this->pageTitle=Yii::app()->name . ' - 翻译示例';
$this->breadcrumbs=array(
	$model->title,
);
?>

     <div id="bd" class="examples">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
                        <div class="exampleCon">
<?php $this->widget('zii.widgets.CMenu',array(
    'id'=>'category',
    'htmlOptions'=>array('class'=>'category'),
    'activeCssClass'=>'selected',
    'items'=>$dataArr,
)); ?>
                            <div class="exampleList">
                                <div id="toTransCon">
                                    <div class="examTitle">原文：</div>
                                    <div class="transCon">
                                        <p style="text-indent:2em;">
                                            <?php echo nl2br($model->original); ?>
                                        </p>
                                    </div>
                                </div>
                                <div id="transCon">
                                    <div class="examTitle">译文：</div>
                                    <div class="transCon">
                                        <p style="text-indent: 2em;line-height: 36px;">
                                            <?php echo nl2br($model->translation); ?>
                                        </p>
                                    </div>
                            	</div>
                            </div>
                        </div>
                        <div class="promise">
                            <ul>
                                <li>1、以上翻译内容，均来自语联网专业翻译人工翻译，专业级质量结果。</li>
                                <li>2、我们郑重承诺，对于客户翻译内容、个人信息严格保密，未经客户允许，决不公开。</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
