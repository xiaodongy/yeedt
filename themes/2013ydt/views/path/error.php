<link type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/others.css" rel="stylesheet">
<?php
$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'错误提醒',
);
?>

    <div id="bd" class="support-des others">
        <div class="bd-border">
            <div class="bd-padding">
                <div class="bd-inner-border">
                    <div class="bd-content">
                        <div class="user-info">
                            <h2 class="title">Error <?php echo $code; ?></h2>
                            <h3><?php echo CHtml::encode($message); ?></h3><p><img src="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/images/404.jpg" width="378" height="130" /></p>
                            <p>请点击访问其他页面：<?php echo CHtml::link("译点通首页",array('/path/index')); ?> <?php echo CHtml::link("快速翻译",array('/path/fast')); ?> <?php echo CHtml::link("文档翻译",array('/path/file')); ?></p>
                         
                        </div>
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                    </div>
                </div>
            </div>
        </div>
    </div>