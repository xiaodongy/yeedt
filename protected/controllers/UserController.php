<?php

class UserController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public $_message = "";
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
            /*
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
            ),
             */
		);
	}
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
            array('allow',
                'actions'=>array('notifyAlipay','r'),
                'users'=>array('*'),
            ),
			array('allow',
                'actions'=>array('panel','r','referral','receiveRebates','translateResult','chargeResult','getUserInfo','orderResult','orderPay','chongzhi','charge','captcha','returnAlipay','download','downloadTDocument'),
                'roles'=>array('member'),
			),
			array('allow',
				'actions'=>array('orderFast','orderFile','chargeAdmin','orderResult','fastEdit','download','downloadTDocument','checkRates','upload','view','uploadDocument'),
				'roles'=>array('interpreter','operator'),
			),
            array('allow',
                'actions'=>array('admin','update','delete'),
                'roles'=>array('admin'),
            ),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

    public function actionOrderResult($orderId)
    {
        if('member' == Yii::app()->user->roles)
            $model = Translate::model()->findByPk($orderId,"user_id=:user_id",array(":user_id"=>Yii::app()->user->id));
        else
            $model = Translate::model()->findByPk($orderId);

        if($model === null)
			    throw new CHttpException(404,'The requested page does not exist.');

        $comment = Comment::model()->findByAttributes(array("translate_id"=>$model->id));
        if($comment === null){
		    $comment = new Comment;
            $comment->level = 1;
            $comment->type = "evaluate";
            $comment->create_time = time();
            $comment->translate_id = $model->id;
        }

		if(isset($_POST['Comment']))
		{
			$comment->attributes=$_POST['Comment'];
			if($comment->save()){
                Yii::import('ext.EUserFlash');
                EUserFlash::setSuccessMessage('提交成功！');
				$this->refresh();
            }
        }

		$this->render('orderResult',array(
			'model'=>$model,
            'comment'=>$comment,
		));
	}

	public function actionOrderPay($orderId, $pay=false)
    {
        $model = Translate::model()->findByPk($orderId,"user_id=:user_id",array(":user_id"=>Yii::app()->user->id));
        if($model === null || 0 >= $model->price || "paid" == $model->status)
			throw new CHttpException(404,'The requested page does not exist.');

        if (1 == $pay)
        {
            $user = User::model()->findByPk(Yii::app()->user->id);
            if($user->balance < $model->price)
                $this->redirect(array('user/chongzhi','orderId'=>$model->id,'userId'=>$user->email));
            else
            {
                $transaction=Yii::app()->db->beginTransaction();
                try{
                    $user->balance -= $model->price;
                    $user->consumer_state = 'consumed';
                    $user->save(false);

                    $charge = new Charge;
                    $charge->chargetype = 0;
                    $charge->money = $model->price;
                    $charge->recharge_way = "";
                    $charge->translate_id = $orderId;
                    $charge->user_id = Yii::app()->user->id;
                    $charge->charge_time = time();
                    //var_dump($charge);exit();
                    $charge->save(false);

                    $model->status = "paid";
                    $model->save(false);
                    $transaction->commit(); //提交事务会真正的执行数据库操作

                    $type = ('fast' == $model->type) ? "快译" : "文档";
                    $demand = !empty($model->demand) ? '其他需求：' . $model->demand : '';
                    if(!empty(Yii::app()->params['operatorPhone'])){
            		    RegForm::sendSms(Yii::app()->params['operatorPhone'],'【译点通】有新的' . $type . '订单已付款，订单号：' . $model->id . '；字数：' . $model->word_count . '个。请及时处理！' . $demand);
		            }
            		if(!empty(Yii::app()->params['interpreterPhone'])){
            		    RegForm::sendSms(Yii::app()->params['interpreterPhone'],'【译点通】有新的' . $type . '订单已付款，订单号：' . $model->id . '；字数：' . $model->word_count . '个。请及时处理！' . $demand);
            		}
                    Yii::import('ext.EUserFlash');
                    EUserFlash::setSuccessMessage('付款成功！');
                    $this->redirect(array('orderResult','orderId'=>$model->id));
                } catch (Exception $e) {
                    $transaction->rollback();//如果操作失败, 数据回滚
                }
            }
        }
        $this->render('orderPay',array('model'=>$model));
	}

	public function actionFastEdit($orderId)
	{
		$model=FastEdit::model()->findByPk($orderId,"type=:type",array(':type'=>"fast"));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

        if(isset($_POST['ajax']) && $_POST['ajax']==='fast-edit-fastedit-form')
        {
            echo CActiveForm::validate($model);
        	Yii::app()->end();
        }

		if(isset($_POST['FastEdit']))
		{
		    $model->attributes=$_POST['FastEdit'];
            if(!empty($model->translation))
            {
			    $model->status = 'finish';
                $model->completion_time = time();
            }
			if($model->save())
			{
			    $to = $model->phone ? $model->phone : $model->user->phone;
                if(!empty($to))
    			    RegForm::sendSms($to,'【译点通】恭喜你,快译订单已经翻译完成！订单号：' . $model->id);
			    Yii::import('ext.EUserFlash');
                EUserFlash::setSuccessMessage('译文内容提交成功！');
				$this->redirect(array('orderResult','orderId'=>$model->id));
			}
        }

		$this->render('fastEdit',array(
			'model'=>$model,
        ));
    }

	public function actionUploadDocument($orderId)
	{
		$model=UploadDocument::model()->findByPk($orderId,"type=:type",array(':type'=>"file"));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

		if(isset($_POST['ajax']) && $_POST['ajax']==='upload-document-uploadDocument-form')
		{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
        }

		if(isset($_POST['UploadDocument']))
		{
			$model->attributes=$_POST['UploadDocument'];
			$documentUpload=CUploadedFile::getInstance($model,'t_document');
            if($model->validate())
            {
                $model->t_document = $documentUpload->name;
                $old_document = $model->t_upload_file_name;
                $model->t_upload_file_name = date('Ymdhis').rand(100,999).'.'.$documentUpload->extensionName;
                $model->status = 'finish';
                $model->completion_time = time();
                if($model->save())
                {
                    if($model->t_document !== null)
                        $documentUpload->saveAs(Yii::getPathOfAlias('webroot').'/upload/t/' . $model->t_upload_file_name);
                    if(!empty($old_document) && $old_document !== $model->t_upload_file_name)
                    	unlink(Yii::getPathOfAlias('webroot').'/upload/t/' . $old_document);
                }
			    RegForm::sendSms($model->phone,'【译点通】恭喜你,文档订单已翻译完成！订单号：' . $model->id);
                Yii::import('ext.EUserFlash');
                EUserFlash::setSuccessMessage('译文文档上传成功！');
				$this->refresh();
            }
		}

		$this->render('uploadDocument',array(
			'model'=>$model,
		));
	}

	public function actionCheckRates($orderId)
	{
		$model=CheckRates::model()->findByPk($orderId,"type=:type",array(":type"=>"file"));
        if($model===null)
            throw new CHttpException(404,'The requested page does not exist.');

		if(isset($_POST['ajax']) && $_POST['ajax']==='check-rates-checkRates-form')
		{
        	echo CActiveForm::validate($model);
        	Yii::app()->end();
        }

        if(isset($_POST['CheckRates']))
        {
        	$model->attributes=$_POST['CheckRates'];
        	if($model->validate())
        	{
        		if($model->save())
        		{
        		    if(0 != $model->word_count && 0 != $model->price)
        		    {
        			    RegForm::sendSms($model->phone,'【译点通】你的文档订单已确认，请尽快付款！订单号：' . $model->id . '。价格：' . $model->price . '元');
        		    }
        			Yii::import('ext.EUserFlash');
                	EUserFlash::setSuccessMessage('订单已确认成功！');
					$this->refresh();
				}
        	}
    	}
    	$this->render('checkRates',array('model'=>$model));
	}

	public function actionDownload($orderId)
	{
		$model=Translate::model()->findByPk($orderId, 'document!=:document',array(':document'=>""));
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

		$fileName = 'upload/' . $model->upload_file_name;
		if(!file_exists($fileName))
            throw new CHttpException(404,'原文文档不存在！');

		$mimeType = pathinfo($fileName, PATHINFO_EXTENSION);
		if (strpos($_SERVER['HTTP_USER_AGENT'], 'MSIE') or strpos($_SERVER['HTTP_USER_AGENT'], 'Opera'))
		{
            $model->document = urlencode($model->document);
			$mimeType = 'application/x-download';
		}
		header('Content-Disposition: attachment; filename=' . $model->document);
		header('Content-Type: charset=utf-8; ' . $mimeType);
		header('Content-Length: ' . filesize($fileName));
		readfile($fileName);
    }

	public function actionDownloadTDocument($orderId)
	{
		$model=Translate::model()->findByPk($orderId, 'status=:status',array(':status'=>'finish'));
		if($model===null)
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

    public function actionPanel()
    {
		$this->render('panel',array(
			'user'=>$this->loadModel(Yii::app()->user->id),
		));
    }

    public function actionR()
    {
        $i = $_GET['i'];
        $utm_campaign = "UserReferral";
        $utm_medium = "(none)";
        $utm_source = "(none)";
        $utm_content = str_replace("i",'u',$i);
        $utm_term = "index";
        if(Yii::app()->user->isGuest)
            Yii::app()->session['referrals'] = str_replace("i",'',$i);
    	$this->redirect(array('path/index',"utm_campaign"=>$utm_campaign,"utm_medium"=>$utm_medium,"utm_source"=>$utm_source,"utm_content"=>$utm_content,"utm_term"=>$utm_term));
    }

    public function actionReferral()
    {
        $model=new Referral('search');
        $this->render('referralResult',array(
            'model'=>$model,
        ));
    }

    public function actionReceiveRebates($referralId)
    {
        $referral = Referral::model()->findByPk($referralId,"user_id=:user_id and is_rebates=:is_rebates",array("user_id"=>Yii::app()->user->id,":is_rebates"=>'0'));
        $user = User::model()->findByPk($referral->yuid);
        if($referral === null || 'consumed' != $user->consumer_state)
            throw new CHttpException(404,'The requested page does not exist.');
        $referral->is_rebates = 1;
        if ($referral->save())
        {
            $charge = new Charge;
            $charge->chargetype = 1;
            $order = Translate::model()->findByAttributes(array('user_id'=>$referral->yuid,'status'=>'finish'),array('order'=>'create_time ASC'));
            $charge->money = $order->price;
            $charge->charge_time = time();
            $charge->recharge_way = 'referral';
            $charge->user_id = Yii::app()->user->id;
            $charge->save();
            $user = User::model()->findByPk(Yii::app()->user->id);
            $user->balance += ($charge->money) * Yii::app()->params['rebate_ratio'];
            $user->save(false);
            $this->eUserFlash("领取返利成功！");
        }
        $this->redirect(array("user/referral"));
    }

    public function actionChongzhi($source="",$orderId="",$userId="")
    {
        $order = Translate::model()->findByPk($orderId,"user_id=:user_id",array(":user_id"=>Yii::app()->user->id));
        if($order===null || 0 >= $order->price || "paid" == $order->status)
            throw new CHttpException(404,'The requested page does not exist.');

        $user = $this->loadModel(Yii::app()->user->id);
        if($userId !== $user->email){
            throw new CHttpException(400,'The requested page does not exist.');
        }

        $model=new ChongzhiForm;
        $model->money = number_format($order->price - $user->balance, 2);
        if(isset($_POST['ChongzhiForm']))
        {
            $model->attributes=$_POST['ChongzhiForm'];
            if($model->validate()){
                $charge_info = $model->attributes;
                if($charge_info['money'] < $model->money)
                    throw new CHttpException(400,'支付失败！');

                $charge_info['charge_time'] = time();
                $charge_info['user_id'] = $user->id;

                $alipay = Yii::app()->alipay;
                // If starting a guaranteed payment, use AlipayGuaranteeRequest instead
                $request = new AlipayDirectRequest();
                $charge = new Charge;
                $charge->recharge_way = $charge_info['recharge_way'];
                $charge->user_id = $user->id;
                $charge->save(false);
                $charge_info['id'] = $charge->primaryKey; // Prints the last id.

                //网银支付模块
                if("alipay" !== $charge_info['recharge_way']) {
                    $request->paymethod = "bankPay";
                    $request->defaultbank = $charge_info['recharge_way'];
                }

                $request->out_trade_no = $order->type . '-' . $order->id . '-' . $charge_info['id'];
                $request->subject = "[译点通专业翻译]充值订单号：" . $charge_info['id'];
                $request->body = "充值" . number_format($charge_info['money'],2) . "元";
                $request->total_fee = number_format($charge_info['money'],2);
                //var_dump($request);exit();
                // Set other optional params if needed
                $form = $alipay->buildForm($request);
                echo $form;
                exit();
            }
        }

		$this->render('chongzhi',array(
            'model'=>$model,
            'order'=>$order,
            'user'=>$user,
		));
    }

    public function actionCharge($source="",$orderId="",$userId="")
    {
        $model=new chargeForm;
        if(isset($_POST['ChargeForm']))
        {
            $model->attributes=$_POST['ChargeForm'];
            if($model->validate()){
                $charge_info = $_POST['ChargeForm'];
                $charge_info['charge_time'] = time();
                $charge_info['user_id'] = Yii::app()->user->id;

                $alipay = Yii::app()->alipay;
                // If starting a guaranteed payment, use AlipayGuaranteeRequest instead
                $request = new AlipayDirectRequest();
                $charge = new Charge;
                $charge->recharge_way = $charge_info['recharge_way'];
                $charge->user_id = Yii::app()->user->id;
                $charge->save(false);
                $charge_info['id'] = $charge->primaryKey; // Prints the last id.
                //网银支付模块
                if("alipay" !== $charge_info['recharge_way']) {
                    $request->paymethod = "bankPay";
                    $request->defaultbank = $charge_info['recharge_way'];
                }

                $request->out_trade_no = 'charge-' . $charge_info['id'];
                $request->subject = "[译点通专业翻译]充值订单号：" . $charge_info['id'];
                $request->body = "充值" . number_format($charge_info['money'],2) . "元";
                $request->total_fee = number_format($charge_info['money'],2);
                //var_dump($request);exit();
                // Set other optional params if needed
                $form = $alipay->buildForm($request);
                echo $form;
                exit();
            }
        }
        $this->render('charge',array(
            'model'=>$model,
		));
    }

    // Server side notification
    public function actionNotifyAlipay() {
        $alipay = Yii::app()->alipay;
        if ($alipay->verifyNotify()) {
            $order_id = $_POST['out_trade_no'];
            $order_fee = $_POST['total_fee'];
            if($_POST['trade_status'] == 'TRADE_FINISHED' || $_POST['trade_status'] == 'TRADE_SUCCESS') {
                if (strpos($order_id, "charge") === false)
                    $this->updateOrderStatus($order_id, $order_fee, $_POST['trade_status']);
                else
                    $this->chargeAccount($order_id, $order_fee, $_POST['trade_status']);
                echo "success";
            }
            else {
                echo "success";
            }
        } else {
            $this->delete_order_record($order_id);
            //echo "fail";
            throw new CHttpException(404,'交易失败！');
            exit();
        }
    }

    //Redirect notification
    public function actionReturnAlipay() {
        $alipay = Yii::app()->alipay;
        if ($alipay->verifyReturn()) {
            $order_id = $_GET['out_trade_no'];
            $order_fee = $_GET['total_fee'];

            if($_GET['trade_status'] == 'TRADE_FINISHED' || $_GET['trade_status'] == 'TRADE_SUCCESS') {
                if (strpos($order_id, "charge") === false)
                    $this->updateOrderStatus($order_id, $order_fee, $_GET['trade_status']);
                else
                    $this->chargeAccount($order_id, $order_fee, $_GET['trade_status']);

                if(empty($this->_message))
                    $this->_message = "恭喜您，交易成功！";
                $this->eUserFlash($this->_message);
                $user = User::model()->findByPk(Yii::app()->user->id);
                $this->render('/user/panel',array('user'=>$user));
            }
            else {
                echo "trade_status=".$_GET['trade_status'];
            }
        } else {
            $this->delete_order_record($order_id);
            //echo "fail";
            throw new CHttpException(404,'交易失败！');
            exit();
        }
    }

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new User;

		// Uncomment the following line if AJAX validation is needed
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate($id)
	{
		$model = $this->loadModel($id);
        $model->rebate_ratio = $model->user_center['rebate_ratio'];
        $model->sharing_ratio = $model->user_center['sharing_ratio'];

		// Uncomment the following line if AJAX validation is needed
        if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

		if(isset($_POST['User']))
		{
			$model->attributes=$_POST['User'];
            if($model->rebate_ratio && $model->sharing_ratio)
            {
                $model->user_center['rebate_ratio'] = $model->rebate_ratio;
                $model->user_center['sharing_ratio'] = $model->sharing_ratio;
                $model->user_center->save(false);
            }
			if($model->save(false))
				$this->redirect(array('view','id'=>$model->id));
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	public function actionGetUserInfo()
	{
        //var_dump(Yii::app()->user->id); exit();
		$model = GetUserInfoForm::model()->findByPk(Yii::app()->user->id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');

        if(isset($_POST['ajax']) && $_POST['ajax']==='get-user-info-form-getUserInfo-form')
        {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }

		if(isset($_POST['GetUserInfoForm']))
		{
			$model->attributes=$_POST['GetUserInfoForm'];
            if($model->save())
            {
                Yii::app()->user->name = $model->name;
                /*
                Yii::app()->user->phone = $model->phone;
                Yii::app()->user->receive_email = $model->receive_email;
                if($model->qq)
                    Yii::app()->user->qq = $model->qq;
                 */
                Yii::import('ext.EUserFlash');
                EUserFlash::setSuccessMessage('您已提交成功！');
				$this->refresh();
            }
		}

		$this->render('getUserInfo',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		if(Yii::app()->request->isPostRequest)
		{
			// we only allow deletion via POST request
			$this->loadModel($id)->delete();

			// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
			if(!isset($_GET['ajax']))
				$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
		}
		else
			throw new CHttpException(400,'Invalid request. Please do not repeat this request again.');
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('User');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new User('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['User']))
			$model->attributes=$_GET['User'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

    public function actionTranslateResult()
    {
		$model=new Translate('search');
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Translate']))
			$model->attributes=$_GET['Translate'];

		$this->render('translateResult',array(
			'model'=>$model,
		));
    }

    public function actionOrderFast()
    {
		$model=new Translate('search');
		$model->status = 'paid';
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Translate']))
			$model->attributes=$_GET['Translate'];

		$this->render('orderFast',array(
			'model'=>$model,
		));
    }

    public function actionOrderFile()
    {
		$model=new Translate('search');
		$model->status = 'new';
		//$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Translate']))
			$model->attributes=$_GET['Translate'];

		$this->render('orderFile',array(
			'model'=>$model,
		));
    }

    public function actionChargeResult()
    {
		$model=new Charge('search');
        $model->chargetype = 1;

		if(isset($_GET['Charge']))
			$model->attributes=$_GET['Charge'];

		$this->render('chargeResult',array(
			'model'=>$model,
		));
    }

    public function actionChargeAdmin()
    {
        $model = new Charge('search');

        if(isset($_GET['Charge']))
            $model->attributes = $_GET['Charge'];

        $this->render('chargeAdmin', array(
            'model' => $model,
        ));
    }

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer the ID of the model to be loaded
	 */
	public function loadModel($id)
	{
		$model=User::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
    }

    public function updateOrderStatus($order_id, $total_fee, $trade_status)
    {
        $transaction=Yii::app()->db->beginTransaction();
        try{
            $arr_order_id = explode("-",$order_id);

            $orderId = $arr_order_id[1];
            $order = Translate::model()->findByPk($orderId);
            if($order===null)
                throw new CHttpException(404,'交易失败！订单号不存在。');

            $chargeId = $arr_order_id[2];
            $charge = Charge::model()->findByPk($chargeId);
            if($charge===null)
		        throw new CHttpException(404,'交易失败！交易号不存在。');

            if(0 >= $charge->money && empty($charge->charge_time))
            {
            	$charge->chargetype = 1;
            	$charge->money = $total_fee;
            	$charge->charge_time = time();
            	$charge->recharge_way = 'alipay';
                if($charge->save(false))
                {
                    $user = $this->loadModel($charge->user_id);
                    if($order->price <= ($user->balance + $total_fee))
                    {
                        $user->balance = $user->balance + $total_fee - $order->price;
                        $user->consumer_state = 'consumed';
                        if($user->save(false))
                        {
                            $charge = new Charge;
                            $charge->chargetype = 0;
                            $charge->money = $order->price;
                            $charge->recharge_way = "";
                            $charge->translate_id = $order->id;
                            $charge->user_id = $user->id;
                            $charge->charge_time = time();
                            $charge->save(false);

                            $order->status = paid;
                            $order->save(false);
                    	    $this->_message = '订单支付成功！';

                            $type = ('fast' == $order->type) ? "快译" : "文档";
                            $demand = !empty($order->demand) ? '其他需求：' . $order->demand : '';
                            if(!empty(Yii::app()->params['operatorPhone'])){
                    		    RegForm::sendSms(Yii::app()->params['operatorPhone'],'【译点通】有新的' . $type . '订单已付款，订单号：' . $order->id . '；字数：' . $order->word_count . '个。请及时处理！' . $demand);
		                    }
            	        	if(!empty(Yii::app()->params['interpreterPhone'])){
                    		    RegForm::sendSms(Yii::app()->params['interpreterPhone'],'【译点通】有新的' . $type . '订单已付款，订单号：' . $order->id . '；字数：' . $order->word_count . '个。请及时处理！' . $demand);
                    		}
                        }
                    } else {
                        $user->balance += $total_fee;
                        $user->consumer_state = 'consumed';
                        $user->save(false);

                	    $this->_message ='余额不足以支付订单！充值金额：' . number_format($total_fee,2) . "元";
                    }
                }
            }
            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $transaction->rollback();//如果操作失败, 数据回滚
        }
    }

    public function chargeAccount($order_id, $total_fee, $trade_status)
    {
        $transaction=Yii::app()->db->beginTransaction();
        try{
            $charge = Charge::model()->findByPk(substr($order_id,7));
            if($charge===null)
			    throw new CHttpException(404,'交易失败！交易号不存在。');

            if(0 >= $charge->money && empty($charge->charge_time))
            {
            	$charge->chargetype = 1;
            	$charge->money = $total_fee;
            	$charge->charge_time = time();
            	$charge->recharge_way = 'alipay';
            	if($charge->save(false))
            	{
           	        $user = User::model()->findByPk($charge->user_id);
    	            $user->balance += $total_fee;
                    $user->consumer_state = 'consumed';
                    $user->save(false);

            	    $this->_message = '充值成功！';
            	}
            }
            $transaction->commit(); //提交事务会真正的执行数据库操作
        } catch (Exception $e) {
            $transaction->rollback();//如果操作失败, 数据回滚
        }
    }

    public function delete_order_record($order_id)
    {
    	$charge_id = substr($order_id,7);
    	$charge = Charge::model()->findByPk($charge_id,"money=:money",array(":money"=>""));
    	if ($charge)
    		$charge->delete($charge_id);
    }

	/**
	 * Performs the AJAX validation.
	 * @param CModel the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='user-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
	
	public function eUserFlash($_message)
	{
	    Yii::import('ext.EUserFlash');
	    EUserFlash::setSuccessMessage($_message);
	}
}
