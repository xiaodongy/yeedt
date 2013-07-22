<?php
class PathController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CaptchaExtendedAction',
				'minLength'=>5,
                'maxLength'=>5,
                'height' => '40px',
                'width' => '128px',
                'offset' => '5',
                'padding' => '2px',
                'testLimit' => 1,
			),
			// page action renders "static" pages stored under 'protected/views/path/pages'
			// They can be accessed via: index.php?r=path/page&view=FileName
			'page'=>array(
                'defaultView'=>'index',
				'class'=>'CViewAction',
			),
		);
	}

    public function actionExample($type="")
    {
        $dataMenu = Example::model()->findAll(array('order'=>'position ASC'));

        if($dataMenu === null)
            throw new CHttpException(404,'The requested page does not exist.');

        foreach($dataMenu as $data)
            $dataArr[$data->code] = array('label'=>$data->title,'url'=>array('/path/example','type'=>$data->code));

        $type = isset($_GET['type']) ? $_GET['type'] : 'personal';
        $model = Example::model()->findByAttributes(array('code'=>$type));

		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
        $this->render('example',array(
            'dataArr'=>$dataArr,
            'model'=>$model,
        ));
    }

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
		// renders the view file 'protected/views/path/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('index');
	}

    public function actionFast($orderId="")
    {
        $model=new FastForm;
        if(isset(Yii::app()->session['original']) && Yii::app()->session['original'])
            $model->original = Yii::app()->session['original'];
        if(isset($_COOKIE['original']) && $_COOKIE['original'] != "")
            $model->original = $_COOKIE['original'];
        if(!Yii::app()->user->isGuest) {
        	$model->phone = User::model()->findByPk(Yii::app()->user->id)->phone;
        	if(!empty($orderId)){
        		$model = $model->findByPk($orderId);
        		if('fast' != $model->type || 'new' != $model->status || Yii::app()->user->id != $model->user_id)
            		throw new CHttpException(400,'The requested page does not exist.');
            }
        }

        // uncomment the following code to enable ajax-based validation
        if(isset($_POST['ajax']) && $_POST['ajax']==='fast-form-fast-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['FastForm']))
        {
            $model->attributes=$_POST['FastForm'];
            Yii::app()->session->add('original',$model->original);
            setcookie('original', $model->original);
            if($model->validate())
            {
                if(Yii::app()->user->isGuest){
                    Yii::import('ext.EUserFlash');
                	EUserFlash::setSuccessMessage('请先登录再下单！');
                	Yii::app()->user->loginRequired();
                }
                $user = User::model()->findByPk(Yii::app()->user->id);
                if(!$user->phone){
                	$user->phone = $model->attributes['phone'];
                    $user->consumer_state = 'orders';
                	$user->save(false);
                }
                $model->user_id = $user->id;
                $model->type = 'fast';
                $model->status = 'new';
                $model->language = (!empty($model->original) && 0 < $model->str_utf8_chinese_word_count($model->original)) ? 'ch_en' : 'en_ch';
                $word_len = $model->str_utf8_mix_word_count($model->original);
                $model->word_count = ($model->word_count >= $word_len) ? $model->word_count : $word_len;
                $model->price = $model->word_count * Yii::app()->params['priceForFast'];
                if($model->save() && 0 < $model->price)
                {
                    Yii::app()->session->add('original','');
                	if($user->balance < $model->price)
                    	$this->redirect(array('user/chongzhi','source'=>'fast','orderId'=>$model->id,'userId'=>$user->email));
                    else
                    	$this->redirect(array('user/orderPay','orderId'=>$model->id));
                }
            }
        }

        $this->render('fast',array('model'=>$model,'translateResult'=>$model->getTranslateResult(),'orderId'=>$orderId));
    }

    public function actionFile()
    {
        $model=new FileForm;
        // uncomment the following code to enable ajax-based validation
        if(isset($_POST['ajax']) && $_POST['ajax']==='file-form-file-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['FileForm']))
        {
            $model->attributes=$_POST['FileForm'];
            $documentUpload=CUploadedFile::getInstance($model,'document');
            if($model->validate())
            {
                $model->document = $documentUpload->name;
                $model->upload_file_name=date('Ymdhis').rand(100,999).'.'.$documentUpload->extensionName;
                $model->word_count = '0';
                $model->price = '0.0';
                $model->type = 'file';
                $model->status = 'new';
                if($model->save())
                {
                    if(!Yii::app()->user->isGuest){
                        $user = User::model()->findByPk(Yii::app()->user->id);
                        $user->name = empty($user->name) ? $model->name : "";
                        $user->phone = empty($user->phone) ? $model->phone : "";
                        $user->receive_email = empty($user->receive_email) ? $model->email : "";
                        $user->qq = empty($user->qq) ? $model->qq : "";
                        $user->consumer_state = 'orders';
                        $user->save(false);
                    }
                    if($model->document !== null)
                        $documentUpload->saveAs(Yii::getPathOfAlias('webroot').'/upload/' . $model->upload_file_name);
                }
                $demand = !empty($model->demand) ? '其他需求：' . $model->demand : '';
		        if(!empty(Yii::app()->params['operatorPhone'])){
			        RegForm::sendSms(Yii::app()->params['operatorPhone'],'【译点通】有新的文档订单，订单号：' . $model->id . '。请即时确认！' . $demand);
		        }
		        if(!empty(Yii::app()->params['interpreterPhone'])){
			        RegForm::sendSms(Yii::app()->params['interpreterPhone'],'【译点通】有新的文档订单，订单号：' . $model->id . '。请即时确认！' . $demand);
		        }
                #$this->redirect(array("path/viewOrder","orderId"=>$model->id));
            Yii::import('ext.EUserFlash');
            //$rengong = CHtml::link("等待客服MM联系我",array("path/sendEmail","type"=>"rengong","orderId"=>$model->id,"email"=>$model->email),array("target"=>"_blank"));
            $rengong = Yii::app()->createUrl("path/sendEmail",array("type"=>"rengong","orderId"=>$model->id,"email"=>$model->email));
            //$auto = CHtml::link("请选择自动报价",array("path/sendEmail","type"=>"auto","orderId"=>$model->id,"email"=>$model->email),array("target"=>"_blank"));
            //EUserFlash::setSuccessMessage('<h3>文档提交成功，您可以选择：</h3><p style="padding: 10px;">' . $rengong . '</p><p style="padding: 5px;font-size: 75%;">1、自助下单成交更快捷，且价格和客服报价一致。<br />2、若您的文档需要加急翻译或有排版等特殊要求，建议选择客服联系。<br />3、客服的工作时间为周一至周日：9点-12点，13点-18点，该时间段外，强烈建议选择自助下单。</p>');
            EUserFlash::setSuccessMessage('<p>客户专员会在接到订单后 10 分钟内分析订单，然后电话通知您具体价格和翻译时间。请您耐心等待，谢谢！</p>
                                            <p>有问题可致电：400-6608-163</p>
                                            <p>或发送邮件到：fanyi@corp.youdao.com</p>
                                            <p><a class="control-btn clog-js" data-act="redirect-file" href="' . $rengong . '" target="_blank" hidefocus="true">我知道了</a></p>
                ');
                $this->refresh();
            }
        }
        if(!Yii::app()->user->isGuest){
            $user = User::model()->findByPk(Yii::app()->user->id);
            $model->name = $user->name;
            $model->email = empty($user->receive_email) ? $user->email : $user->receive_email;
            $model->phone = $user->phone;
            $model->qq = $user->qq;
        }
        $this->render('file',array('model'=>$model));
    }

    public function actionSendEmail($type,$orderId,$email)
    {
        $model = Translate::model()->findByPk($orderId,"email=:email",array(":email"=>$email));
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');

        $action = ('rengong' == $type) ? 'viewOrder' : 'autoBaojia';
        $this->redirect(array("path/$action","orderId"=>$orderId,"email"=>$email));
    }

    public function actionViewOrder($orderId,$email)
    {
        $model = Translate::model()->findByPk($orderId,"email=:email",array(":email"=>$email));
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');
	  
        $pay_url = Yii::app()->user->isGuest ? "path/filePay" : "user/orderPay";
        $this->render('viewOrder',array('model'=>$model,'pay_url'=>$pay_url));
    }

    public function actionAutoBaojia($orderId,$email)
    {
        $model = AutoBaojia::model()->findByPk($orderId,"email=:email",array(":email"=>$email));
        if($model === null)
            throw new CHttpException(404,'The requested page does not exist.');
        
		$model->word_count = FastForm::str_utf8_mix_word_count(file_get_contents('upload/' . $model->upload_file_name));
		$model->price = $model->word_count * Yii::app()->params['priceForFile'];
		$model->price = $model->price < 100 ? 100 : $model->price;
		//$model->save(false);
        if(isset($_POST['AutoBaojia']))
        {
        	$model->attributes=$_POST['AutoBaojia'];
        	if($model->validate())
        	{
        		if($model->save(false))
        		{
        		    if(0 != $model->word_count && 0 != $model->price)
        		    {
				        $pay_url = Yii::app()->user->isGuest ? "path/filePay" : "user/orderPay";
						$this->redirect(array($pay_url,"orderId"=>$orderId,"email"=>$email));
					}
				}
			}
		}

		$this->render('autoBaojia',array('model'=>$model));
    }
	
	public function actionTranslatorReviser()
	{
		echo "牢记您的订单号：" . Yii::app()->session['orderId'];
		echo "<h1>翻译－审校中...</h1>";
	}
		
	public function actionFileOrderResult($orderId,$email)
	{
		$model = Translate::model()->findByPk($orderId, "email=:email and status=:status",array(":email"=>$email,":status"=>"finish"));
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		
		echo "<h1>文档订单翻译完成</h1>";
		echo "下载译文文档：" . CHtml::link(CHtml::encode($model->t_document),array('path/downloadTDocument',"orderId"=>$model->id,"email"=>$model->email));
	}
	
	public function actionDownloadTDocument($orderId,$email)
	{
		$model = Translate::model()->findByPk($orderId, "email=:email and status=:status",array(":email"=>$email,":status"=>"finish"));
		if($model === null)
			throw new CHttpException(404,'The requested page does not exist.');
		$fileName = 'upload/t/' . $model->t_upload_file_name;
		if(!file_exists($fileName))
			throw new CHttpException(404,'原文文档不存在！');

		$mimeType = pathinfo($fileName, PATHINFO_EXTENSION);
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') or strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
		{
			$model->t_document = urlencode($model->t_document);
			$mimeType = 'application/x-download';
		}
		header('Content-Disposition: attachment; filename=' . $model->t_document);
		header('Content-Type: charset=utf-8; ' . $mimeType);
		header('Content-Length: ' . filesize($fileName));
		readfile($fileName);
	}
		
	public function actionFilePay($orderId)
	{
		$order = Translate::model()->findByPk($orderId);
		if($order === null || 0 >= $order->price || "paid" == $order->status)
			throw new CHttpException(404,'The requested page does not exist.');
	        
		$model=new ChongzhiForm;
		$model->money = number_format($order->price, 2);
		if(isset($_POST['ChongzhiForm']))
		{
			$model->attributes=$_POST['ChongzhiForm'];
			if($model->validate()){
				$charge_info = $model->attributes;
		        if($charge_info['money'] < $model->money)
					throw new CHttpException(400,'支付失败！');
				$charge_info['charge_time'] = time();
		        $charge_info['user_email'] = $order->email;

		        $alipay = Yii::app()->alipay;
		        // If starting a guaranteed payment, use AlipayGuaranteeRequest instead
		        $request = new AlipayDirectRequest();
		        $charge = Charge::model()->findByAttributes(array("translate_id"=>$order->id));
				if ($charge === null) {
					$charge = new Charge;
		            $charge->recharge_way = $charge_info['recharge_way'];
					$charge->translate_id= $order->id;
		            $charge->user_email= $order->email;
		            $charge->save(false);
				}
		        $charge_info['id'] = $charge->id ? $charge->id : $charge->primaryKey; // Prints the last id.
				if("alipay" !== $charge_info['recharge_way']) {
					$request->paymethod = "bankPay";
					$request->defaultbank = $charge_info['recharge_way'];
				}
						
		        $request->out_trade_no = $order->type . '-' . $order->id . '-' . $charge_info['id'];
		        $request->subject = "[译点通专业翻译]订单号：" . $order->id;
		        $request->total_fee = number_format($charge_info['money'],2);
		        $request->body = Lookup::item("FileTranslateLanguages",$order->language) . "， " . $order->word_count . "字";
		        //var_dump($request);exit();
		        // Set other optional params if needed
		        $form = $alipay->buildForm($request);
		        echo $form;
		        exit();
		    }
		}
		$this->render('filePay',array('model'=>$model,'order'=>$order));
	}

    public function actionResume()
    {
        $model=new ResumeForm;
        // uncomment the following code to enable ajax-based validation
        if(isset($_POST['ajax']) && $_POST['ajax']==='resume-form-resume-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['ResumeForm']))
        {
            $model->attributes=$_POST['ResumeForm'];
            $documentUpload=CUploadedFile::getInstance($model,'document');
            if($model->validate())
            {
                $model->document = $documentUpload->name;
                $model->upload_file_name=date('Ymdhis').rand(100,999).'.'.$documentUpload->extensionName;
                $model->word_count = '0';
                $model->price = '0.0';
                $model->type = 'file';
                $model->status = 'new';
                if($model->save())
                {
                    if(!Yii::app()->user->isGuest){
                        $user = User::model()->findByPk(Yii::app()->user->id);
                        $user->name = empty($user->name) ? $model->name : "";
                        $user->phone = empty($user->phone) ? $model->phone : "";
                        $user->receive_email = empty($user->receive_email) ? $model->email : "";
                        $user->qq = empty($user->qq) ? $model->qq : "";
                        $user->save(false);
                    }
                    if($model->document !== null)
                        $documentUpload->saveAs(Yii::getPathOfAlias('webroot').'/upload/' . $model->upload_file_name);
                }
                $demand = !empty($model->demand) ? '其他需求：' . $model->demand : '';
		        if(!empty(Yii::app()->params['operatorPhone'])){
			        RegForm::sendSms(Yii::app()->params['operatorPhone'],'【译点通】有新的文档订单，订单号：' . $model->id . '。请即时确认！' . $demand);
		        }
		        if(!empty(Yii::app()->params['interpreterPhone'])){
			        RegForm::sendSms(Yii::app()->params['interpreterPhone'],'【译点通】有新的文档订单，订单号：' . $model->id . '。请即时确认！' . $demand);
		        }
                Yii::import('ext.EUserFlash');
                EUserFlash::setSuccessMessage('客户专员会在接到订单后 10 分钟内分析订单，然后电话通知您具体价格和翻译时间。请您耐心等待，谢谢！有问题可致电：027-59004033 或发送邮件到：kefu@yeedt.com');
				$this->refresh();
            }
        }
        if(!Yii::app()->user->isGuest){
            $user = User::model()->findByPk(Yii::app()->user->id);
            $model->name = $user->name;
            $model->email = empty($user->receive_email) ? $user->email : $user->receive_email;
            $model->phone = $user->phone;
            $model->qq = $user->qq;
        }
        $this->render('resume',array('model'=>$model));
    }

    public function actionWebSite()
    {
        $model=new WebSiteForm;
        // uncomment the following code to enable ajax-based validation
        if(isset($_POST['ajax']) && $_POST['ajax']==='webSite-form-webSite-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

        if(isset($_POST['WebSiteForm']))
        {
            $model->attributes=$_POST['WebSiteForm'];
            $documentUpload=CUploadedFile::getInstance($model,'document');
            if($model->validate())
            {
                $model->document = $documentUpload->name;
                $model->upload_file_name=date('Ymdhis').rand(100,999).'.'.$documentUpload->extensionName;
                $model->word_count = '0';
                $model->price = '0.0';
                $model->type = 'file';
                $model->status = 'new';
                if($model->save())
                {
                    if($model->document !== null)
                        $documentUpload->saveAs(Yii::getPathOfAlias('webroot').'/upload/' . $model->upload_file_name);
                }
                Yii::import('ext.EUserFlash');
                EUserFlash::setSuccessMessage('客户专员会在接到订单后 10 分钟内分析订单，然后电话通知您具体价格和翻译时间。请您耐心等待，谢谢！有问题可致电：027-59004033 或发送邮件到：kefu@yeedt.com');
				$this->refresh();
            }
        }
        if(!Yii::app()->user->isGuest){
            $user = User::model()->findByPk(Yii::app()->user->id);
            $model->name = $user->name;
            $model->email = empty($user->receive_email) ? $user->email : $user->receive_email;
            $model->phone = $user->phone;
            $model->qq = $user->qq;
        }
        $this->render('webSite',array('model'=>$model));
    }

    public function actionAbout()
	{
		// renders the view file 'protected/views/path/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('about');
    }
    public function actionServer()
	{
		// renders the view file 'protected/views/path/index.php'
		// using the default layout 'protected/views/layouts/main.php'
		$this->render('server');
    }
    public function actionWhyFast()
    {
        $this->render('whyFast');
    }

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
	    if($error=Yii::app()->errorHandler->error)
	    {
	    	if(Yii::app()->request->isAjaxRequest)
	    		echo $error['message'];
	    	else
	        	$this->render('error', $error);
	    }
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(!Yii::app()->user->isGuest){
			$user = User::model()->findByPk(Yii::app()->user->id);
			$model->name = $user->name;
			$model->email = $user->receive_email ? $user->receive_email : $user->email;
			$model->phone = $user->phone;
		}
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				if($model->save(false)){
					Yii::import('ext.EUserFlash');
                	EUserFlash::setSuccessMessage('感谢您提出宝贵的意见或建议，我们会尽可能快的联络你！');
                	$this->refresh();
				}
			}
		}
		$this->render('contact',array('model'=>$model));
	}
	
    public function actionReg()
    {
        if(!Yii::app()->user->isGuest)
            $this->redirect(array('user/panel'));

        //$this->layout=false;
        $model=new RegForm;
/* 
        if(isset($_POST['ajax']) && $_POST['ajax']==='reg-form-reg-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
*/

        if(isset($_POST['RegForm']))
        {
            $model->attributes=$_POST['RegForm'];
            $model->roles = "member";
            $model->join_date = time();
            $model->is_verify = 0;
            $model->consumer_state = "registered";
            if($model->save())
            {
                $referral = new Referral;
                //$referral->status = "registered";
                $referral->is_rebates = 0;
                $referral->user_id = Yii::app()->session['referrals'];
                $referral->yuid = $model->id;
                if ($referral->save())
                    Yii::app()->session->add('referrals','');

                if(!Yii::app()->params['is_verifyEmail']){
                    $identity=new UserIdentity($model->email,$model->password);
                    $identity->authenticate();
                    Yii::app()->user->login($identity);
                    if(isset(Yii::app()->session['original'])){
                        Yii::import('ext.EUserFlash');
                	    EUserFlash::setSuccessMessage('恭喜您，注册成功后可直接下单！');
                        $this->redirect(array('path/fast'));
                    }
                    else {
                        Yii::import('ext.EUserFlash');
                	    EUserFlash::setSuccessMessage('恭喜您，已经注册成功！');
                        $this->redirect(array('user/panel'));
                    }
                } else {
                    $subject = "=?UTF-8?B?".base64_encode('译点通注册会员')."?=";
                    $body = "亲爱的<a href=\"mailto:{$model->email}\">{$model->email}：";
                    $body .= "<p>感谢您申请注册语联网通行证! 请点击链接完成注册：</p>";
                    $verifyUrl = Yii::app()->request->hostInfo . $this->createUrl("regVerify",array('verifyEmail'=>$model->email,"verifyCode"=>md5($model->id .$model->join_date)));
                    $body = "<body>";
                    $body .= "<p><a href=\"{$verifyUrl}\">点击验证语联网通行证帐户</a></p>";
                    $body .= "<p>如果上述文字点击无效，请把下面网页地址复制到浏览器地址栏中打开：<br />";
                    $body .= "<a href=\"{$verifyUrl}\">{$verifyUrl}</a></p>";
                    $body .= "<p>如果您没有申请注册网易通行证，请忽略此邮件。</p>";
                    $body .= "<hr />";
                    $body .= "<p>" . date('Y-m-d') . "</p>";
                    $body .= "<h5>（本邮件由系统自动发出，请勿回复。）</h5>";
                    $body .= "</body>";
                    $headers = 'MIME-Version: 1.0' . "\r\n"; 
                    $headers .= 'Content-type: text/html; charset=utf-8' . "\r\n"; // Additional headers
                    $headers .= "From: coly@live.cn\r\nReply-To: coly@live.cn";
                    mail($model->email,$subject,$body,$headers);
                    $this->redirect(array('path/regVerify','verifyEmail'=> $model->email));
                }
            }
        }
        $this->render('reg',array('model'=>$model));
    }

    public function actionRegVerify($verifyEmail,$verifyCode="")
    {
        //$this->layout=false;
        $model = User::model()->findByAttributes(
            array('email'=>$verifyEmail),
            'is_verify=:is_verify',
            array(':is_verify'=>0)
        );
        if($model===null){
            throw new CHttpException(400,'The requested page does not exist.');
        }
        if(!empty($verifyCode)){
            if($verifyCode !== md5($model->id . $model->join_date))
                throw new CHttpException(400,'The requested page does not exist.');

             if(!Yii::app()->user->isGuest){
                    Yii::app()->user->logout();
                    if(!Yii::app()->getSession()->getIsStarted())
                        Yii::app()->getSession()->open();
             }

            $model->is_verify = 1;
            if($model->save(false)) {
                $identity=new UserIdentity($model->email,$model->password);
                $identity->authenticate();
                Yii::app()->user->login($identity);

                $this->redirect(array('user/panel'));
            }
        }

        $this->render('regVerify',array('email'=>$verifyEmail));
    }

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
        if(!Yii::app()->user->isGuest)
            $this->redirect(array('user/panel'));

	    //$this->layout=false;
		$model=new LoginForm;
		$model->rememberMe = true;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login())
				$this->redirect(Yii::app()->user->returnUrl);
		}
		// display the login form
		$this->render('login',array('model'=>$model));
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}

	public function actionForgetPassword()
	{
	    $model=new ForgetPassword;

	    // uncomment the following code to enable ajax-based validation
	    /*
	    if(isset($_POST['ajax']) && $_POST['ajax']==='forget-password-forgetPassword-form')
	    {
	        echo CActiveForm::validate($model);
	        Yii::app()->end();
	    }
	    */

	    if(isset($_POST['ForgetPassword']))
	    {
	        $model->attributes=$_POST['ForgetPassword'];
	        if($model->validate())
	        {
                $this->redirect(array('path/passwordSent'));
	        }
	    }
	    $this->render('forgetPassword',array('model'=>$model));
	}

    public function actionPasswordSent()
    {
        $this->render('passwordSent');
    }
}
