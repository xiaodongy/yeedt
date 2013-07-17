<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

	<!-- blueprint CSS framework -->
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/screen.css" media="screen, projection" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/print.css" media="print" />
	<!--[if lt IE 8]>
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie.css" media="screen, projection" />
	<![endif]-->

	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
	<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/form.css" />

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>

<div class="container" id="page">

	<div id="header">
        <div class="account-item">
        <?php
            $name = isset(Yii::app()->user->email) ? Yii::app()->user->email : Yii::app()->user->name;
            $this->widget('zii.widgets.CMenu',array(
                'id'=>'account-ul',
			    'items'=>array(
				    array('label'=>$name, 'visible'=>!Yii::app()->user->isGuest),
				    array('label'=>'登录', 'url'=>array('/path/login'), 'visible'=>Yii::app()->user->isGuest),
				    array('label'=>'注册', 'url'=>array('/path/reg'), 'visible'=>Yii::app()->user->isGuest),
				    array('label'=>'我的账户', 'url'=>array('/user/panel'), 'visible'=>(Yii::app()->user->checkAccess('member') || Yii::app()->user->isGuest)),
				    array('label'=>'翻译记录', 'url'=>array('/user/translateResult'), 'visible'=>(Yii::app()->user->checkAccess('member') || Yii::app()->user->isGuest)),
				    array('label'=>'快译订单', 'url'=>array('/user/orderFast'), 'visible'=>(Yii::app()->user->checkAccess('interpreter')) || Yii::app()->user->checkAccess('operator')),
				    array('label'=>'文档订单', 'url'=>array('/user/orderFile'), 'visible'=>(Yii::app()->user->checkAccess('interpreter')) || Yii::app()->user->checkAccess('operator')),
				    array('label'=>'帐号管理', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
				    array('label'=>'示例管理', 'url'=>array('/example/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
				    array('label'=>'网站设置', 'url'=>array('/user/admin'), 'visible'=>Yii::app()->user->checkAccess('admin')),
				    array('label'=>'退出', 'url'=>array('path/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
            )); ?>
	    </div><!-- account-item -->
		<div id="logo"><?php echo CHtml::encode(Yii::app()->name); ?></div>
	</div><!-- header -->

	<div id="mainmenu">
		<?php $this->widget('zii.widgets.CMenu',array(
			'items'=>array(
				array('label'=>'首页', 'url'=>array('/path/index')),
				array('label'=>'快速翻译', 'url'=>array('/path/fast')),
				array('label'=>'文档翻译', 'url'=>array('/path/file')),
				array('label'=>'服务说明', 'url'=>array('/path/about')),
				array('label'=>'翻译示例', 'url'=>array('/path/example')),
			),
		)); ?>
	</div><!-- mainmenu -->
	<?php if(isset($this->breadcrumbs)):?>
		<?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?>
	<?php endif?>
	<?php echo $content; ?>

	<div id="footer">
        © 2005-<?php echo date('Y'); ?> 译点通 版权所有，并保留所有权利。<br/>
        北京市朝阳区东三环中路39号建外SOHO 18号楼17层 Tel: 027-59004033 E-mail: kefu@yeedt.com <br/>
	</div><!-- footer -->

</div><!-- page -->

<?php if(!$_GET['noscript']): ?>
<!--[if lte IE 8]>
<noscript>
<style>
//当脚本警用时，将网页上不需要显示的模块都进行隐藏
.html5-wrappers{display:none!important;}
</style>
<div class="ie-noscript-warning">
您的浏览器禁用了脚本，请<a href="">查看这里</a>
来启用脚本!或者<a href="/?noscript=1">继续访问</a>.
</div>
</noscript>
<![endif]-->
<?php endif; ?>

</body>
</html>
