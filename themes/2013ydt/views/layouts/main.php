<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="language" content="zh-cn" />
<link rel="shortcut icon" type="image/x-icon" href="css/default/images/favicon.ico">
<link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/common.css" />
<title><?php echo CHtml::encode($this->pageTitle); ?></title>
<meta name="Keywords" content="在线翻译|专业翻译|快速翻译|简历翻译|英汉翻译|人工翻译|翻译公司|翻译价格" />
<meta name="Description" content="译点通快速精准翻译，专业在线快速人工翻译服务，基于语联网语言翻译引擎，最快1分钟获取结果。提供快速文本翻译，文档翻译，网站翻译等服务，支持txt,doc,pdf,html等多种文档格式。" />
</head>

<body>
<div id="doc1">
  <div id="hd"> <a href="<?php echo Yii::app()->homeUrl; ?>" class="logo" data-act="logo"></a>
    <h1 class="dn">译点通在线翻译</h1>
    <strong class="dn">首创嵌入式翻译服务</strong> 
    <!--[if IE 6]>
        <script src="http://shared.ydstatic.com/at/1.9.3/scripts/lib/DD_belatedPNG_0.0.8a.js"></script>
        <script>
            DD_belatedPNG.fix('.logo');
            DD_belatedPNG.fix('.netease-logo,.sina-logo,.tencent-logo');
        </script>
        <![endif]-->
    <div id="favorite-panel" style="display: none; "></div>
    <div class="nav-list">
      <div>
        <div>
          <?php $name = isset(Yii::app()->user->email) ? Yii::app()->user->email : Yii::app()->user->name; ?>
          <?php if(Yii::app()->user->isGuest): ?>
          <div class="li-left login-div"><?php echo CHtml::link("登录",array('/path/login')); ?></div>
          <div class="li-left reg-div"><?php echo CHtml::link("注册",array('/path/reg')); ?> </div>
          <div class="li-left">|</div>
          <?php else: ?>
          <div class="account-item li-left" title="<?php echo $name; ?>" data-username=""><?php echo $name; ?></div>
          <?php endif; ?>

          <?php if(!Yii::app()->user->checkAccess('admin') && (Yii::app()->user->checkAccess('member') || Yii::app()->user->isGuest)): ?>
            <div class="li-left"><?php echo CHtml::link("我的帐户",array('/user/panel')); ?></div>
            <div class="li-left"><?php echo CHtml::link("翻译记录",array('/user/translateResult')); ?></div>
          <?php endif; ?>

          <?php if(Yii::app()->user->checkAccess('agents') && !Yii::app()->user->checkAccess('admin')): ?>
            <div class="li-left"><?php echo CHtml::link("个人中心",array('/proxy/panel')); ?></div>
            <div class="li-left"><?php echo CHtml::link("客户管理",array('/proxy/referral')); ?></div>
          <?php endif; ?>

          <?php if(Yii::app()->user->checkAccess('interpreter') || Yii::app()->user->checkAccess('operator')): ?>
            <div class="li-left">|</div>
            <div class="li-left"><?php echo CHtml::link("快译订单",array('/user/orderFast')); ?></div>
            <div class="li-left"><?php echo CHtml::link("文档订单",array('/user/orderFile')); ?></div>
            <div class="li-left">|</div>
            <div class="li-left"><?php echo CHtml::link('交易查询',array('/user/chargeAdmin')); ?></div>
          <?php endif; ?>

          <?php if(Yii::app()->user->checkAccess('admin')): ?>
            <div class="li-left">|</div>
            <div class="li-left"><?php echo CHtml::link("用户管理",array('/user/admin')); ?></div>
          <?php endif; ?>

          <?php if(!Yii::app()->user->isGuest): ?>
          <div class="li-left">|</div>
          <div class="li-left"><?php echo CHtml::link("退出",array('/path/logout')); ?>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <div class="contact">
      <div class="navigation"> <?php echo CHtml::link("首页",array('/path/index')); ?> <?php echo CHtml::link("快速翻译",array('/path/fast')); ?> <?php echo CHtml::link("文档翻译",array('/path/file')); ?> <?php echo CHtml::link("简历翻译",array('/path/resume')); ?> <?php echo CHtml::link('网站翻译',array('/path/webSite')); ?> <!--<img src="<?php echo Yii::app()->theme->baseUrl; ?>/images/new.jpg"  style="position:absolute;top:-8px;left:555px;_left:545px" />--> <?php echo CHtml::link("服务说明",array('/path/about')); ?></div>
    </div>
  </div>
  <!---hd end---> 
  
  <?php echo $content; ?>
 
  <div id="ft">
    <p><a href="http://blog.yeedt.com/post-31.html" target="_blank">关于译点通专业翻译</a> | <a href="http://weibo.com/yeedt" target="_blank">译点通新浪微博</a> | <a href="http://blog.yeedt.com" target="_blank">译点通官方博客</a></p>
    <p> <span>© 2005-2013 译点通</span> | <span>京ICP备08001822号</span> <div style="display:none"><script src="http://s24.cnzz.com/stat.php?id=4290608&web_id=4290608" language="JavaScript"></script>
</div></p>
  </div>
</div>
<!---doc1 end--->
<link href="<?php echo Yii::app()->theme->baseUrl; ?>/css/default/OKQQ/images/qq.css" rel="stylesheet" type="text/css" />
<script language='javascript' src='<?php echo Yii::app()->theme->baseUrl; ?>/css/default/OKQQ/ServiceQQ.js' type='text/javascript' charset='gbk'></script>
</body>
</html>
