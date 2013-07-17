<?php

/**
 * This is the model class for table "{{user}}".
 *
 * The followings are the available columns in table '{{user}}':
 * @property integer $id
 * @property string $email
 * @property string $password
 * @property string $name
 * @property string $phone
 * @property string $receive_email
 * @property string $qq
 * @property string $roles
 * @property string $balance
 * @property string $experience
 */
class RegForm extends CActiveRecord
{
    public $re_password;
    public $verifyCode;
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return RegForm the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return '{{user}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('email', 'required','message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入常用邮件地址。</em>'),
			array('email', 'email', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>邮箱格式错误，请检查。</em>'),
			array('email', 'unique', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>该通行证帐号已存在，请直接登录</em>'),
			
			array('password', 'required','message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请设置你的登录密码。</em>'),
			array('password','length','min'=>6,'max'=>16,'tooShort'=>'<span class="err_left"></span><span class="err_info"><span class="err_img1"></span><em>请输入6到16个字符的密码。</em>','tooLong'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入6到16个字符的密码。</em>'),
			
			array('re_password', 'required','message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请再次输入你的登录密码。</em>'),
			
			array('re_password', 'compare', 'compareAttribute'=>'password','message'=>'<span class="err_left"></span><span class="err_img1"></span><em>两次输入的密码不一致。</em>'),
			
			//array('verifyCode', 'required', 'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入正确的验证码。</em>'),
			array('verifyCode', 'CaptchaExtendedValidator', 'allowEmpty'=>!CCaptcha::checkRequirements(),'message'=>'<span class="err_left"></span><span class="err_img1"></span><em>请输入正确的验证码。</em>','safe'=>true,'enableClientValidation'=>true),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'email' => '<span class="star"></span>&nbsp;常用邮件地址：',
			'password' => '<span class="star"></span>&nbsp;设置密码：',
			're_password' => '<span class="star"></span>&nbsp;确认密码：',
			'verifyCode' => '<span class="star"></span>&nbsp;验证码：',
            'referrals' => '<span class="star"></span>&nbsp;推荐人：',
			'name' => 'Name',
			'phone' => 'Phone',
			'receive_email' => 'Receive Email',
			'qq' => 'Qq',
			'roles' => 'Roles',
			'balance' => 'Balance',
			'experience' => 'Experience',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 * @return CActiveDataProvider the data provider that can return the models based on the search/filter conditions.
	 */
	public function search()
	{
		// Warning: Please modify the following code to remove attributes that
		// should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('password',$this->password,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('receive_email',$this->receive_email,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('roles',$this->roles,true);
		$criteria->compare('balance',$this->balance,true);
		$criteria->compare('experience',$this->experience,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
	
	//beforeSave()这个方法是yii自带的
	public function beforeSave(){
	    if(parent::beforeSave()){
            //$this->isNewRecord  是否为新添加用户（新纪录）
            if($this->isNewRecord){
                $this->password=self::encypt($this->password);
            }
			$this->ip = Yii::app()->request->userHostAddress;
			if($this->ip)
				$this->ip_attribution = $this->getIpAttribution($this->ip);
            return true;
        }else{
            return false;
        }
    }

    //给密码进行md5加密
    public static function encypt($pass){
        return md5($pass);
    }

	public function getIpAttribution($ip)
	{
		$text = file_get_contents("http://www.youdao.com/smartresult-xml/search.s?type=ip&q=" . $ip);
		$text = iconv("gbk", "utf-8", $text);
		preg_match('/<location>(.*)<\/location>/is',$text,$arr,PREG_OFFSET_CAPTURE);
		return strip_tags($arr[0][0]);
	}
	
    public function sendMsg($to, $subject, $body)
    {
        $arr_to = explode(",",$to);
        for($i = 0; $i < count($arr_to); $i++)
        {
            $message = new YiiMailMessage;
            $message->setSubject($subject);
            $message->setBody($body,'text/html');
            $message->from = Yii::app()->params['adminEmail'];
            $message->addTo($arr_to[$i]);
            Yii::app()->mail->send($message);
        }
    }

//发送手机短信
public function sendSms($mob,$content){
	$content = iconv("utf-8", "GB2312", $content);
	$url=Yii::app()->params['sendSms_url'] . "?id=" . Yii::app()->params['sendSms_id'] . "&pwd=" . Yii::app()->params['sendSms_pwd'] . "&to=$mob&content=$content";
	if( !$msg=self::sockOpenUrl($url) ){
		//$msg=file_get_contents($url);
	}
	if($msg===''){
		return 0;
	}
	$detail=explode("/",$msg);
	if($detail[0]==='000'){
		return 1;			//发送成功
	}else{
		return $detail[0];
	}
	
}


//sock方式打开远程文件
public function sockOpenUrl($url,$method='GET',$postValue='',$Referer='Y'){
	if($Referer=='Y'){
		$Referer=$url;
	}
	$method = strtoupper($method);
	if(!$url){
		return '';
	}elseif(!ereg("://",$url)){
		$url="http://$url";
	}
	$urldb=parse_url($url);
	$port=$urldb[port]?$urldb[port]:80;
	$host=$urldb[host];
	$query='?'.$urldb[query];
	$path=$urldb[path]?$urldb[path]:'/';
	$method=$method=='GET'?"GET":'POST';

	$fp = fsockopen($host, 80, $errno, $errstr, 30);
	if(!$fp)
	{
		echo "$errstr ($errno)<br />\n";
	}
	else
	{
		$out = "$method $path$query HTTP/1.1\r\n";
		$out .= "Host: $host\r\n";
		$out .= "Cookie: c=1;c2=2\r\n";
		$out .= "Referer: $Referer\r\n";
		$out .= "Accept: */*\r\n";
		$out .= "Connection: Close\r\n";
		if ( $method == "POST" ) {
			$out .= "Content-Type: application/x-www-form-urlencoded\r\n";
			$length = strlen($postValue);
			$out .= "Content-Length: $length\r\n";
			$out .= "\r\n";
			$out .= $postValue;
		}else{
			$out .= "\r\n";
		}
		fwrite($fp, $out);
		while (!feof($fp)) {
			$file.= fgets($fp, 256);
		}
		fclose($fp);
		if(!$file){
			return '';
		}
		$ck=0;
		$string='';
		$detail=explode("\r\n",$file);
		foreach( $detail AS $key=>$value){
			if($value==''){
				$ck++;
				if($ck==1){
					continue;
				}
			}
			if($ck){
				$stringdb[]=$value;
			}
		}
		$string=implode("\r\n",$stringdb);
		//$string=preg_replace("/([\d]+)(.*)0/is","\\2",$string);
		return $string;
	}
}
}
