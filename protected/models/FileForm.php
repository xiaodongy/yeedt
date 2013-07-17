<?php
class FileForm extends CActiveRecord
{
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
	public function tableName()
	{
		return '{{translate}}';
	}
	public function rules()
	{
		return array(
			array('language', 'required', 'message'=>'请选择语言'),
			//array('document', 'required', 'message'=>'请选择文件'),
			array('document', 'file',  'allowEmpty'=>false, 'types'=>'doc,docx,txt,pdf,rar,zip', 'wrongType'=>'不支持的文件类型', 'maxSize' => 1024 * 1024 * 20, 'tooLarge' => '文件大小不能超过20M', 'message'=>'请选择文件'),
            array('document, upload_file_name', 'unsafe'),
            array('name','length','min'=>2,'max'=>8,'tooShort'=>'长度请控制在2-8个字符','tooLong'=>'长度请控制在2-8个字符'),
			array('phone', 'required', 'message'=>'请输入正确的电话号码'),
            //array('phone', 'match','pattern' => '/^(\d{11})|^((\d{7,8})|(\d{4}|\d{3})-(\d{7,8})|(\d{4}|\d{3})-(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1})|(\d{7,8})-(\d{4}|\d{3}|\d{2}|\d{1}))$/','message' => '请输入正确的电话号码'),
            array('phone', 'match','pattern' => '/^((0*\d{1,4}|\+\d{1,4}|\(\d{1,4}\))[ -]?)?(\d{2,4}[ -]?)?\d{3,4}[ -]?\d{3,4}([ -]\d{1,5})?$/','message' => '请输入正确的电话号码'),
			array('email', 'required', 'message'=>'请输入正确的邮箱地址'),
            array('email', 'email', 'message'=>'请输入正确的邮箱地址'),
            array('qq', 'match','pattern' => '/^[1-9]{1}[0-9]{4,14}$/','message' => '请输入正确的QQ号码'),
			array('word_count, create_time, user_id', 'numerical', 'integerOnly'=>true),
			array('original, demand, translation, is_invoice', 'safe'),
			array('id, language, original, word_count, price, demand, name, phone, email, qq, is_invoice, type, status, create_time, translation, user_id', 'safe', 'on'=>'search'),
		);
	}
	public function relations()
	{
		return array(
		);
	}
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'language' => '选择语言：',
			'original' => 'Original',
			'document' => '提交文档：',
			'word_count' => 'Word Count',
			'price' => 'Price',
			'demand' => '其他需求：',
			'name' => '姓名：',
			'phone' => '<i class="important">*</i>电话：',
			'email' => '<i class="important">*</i>常用邮箱：',
			'qq' => 'QQ号码：',
			'is_invoice' => '开发票&nbsp;&nbsp;&nbsp;&nbsp;',
			'type' => 'Type',
			'status' => 'Status',
			'create_time' => 'Create Time',
			'translation' => 'Translation',
			'user_id' => 'User',
		);
	}
	public function search()
	{
		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('language',$this->language,true);
		$criteria->compare('original',$this->original,true);
		$criteria->compare('document',$this->document,true);
		$criteria->compare('word_count',$this->word_count);
		$criteria->compare('price',$this->price,true);
		$criteria->compare('demand',$this->demand,true);
		$criteria->compare('name',$this->name,true);
		$criteria->compare('phone',$this->phone,true);
		$criteria->compare('email',$this->email,true);
		$criteria->compare('qq',$this->qq,true);
		$criteria->compare('is_invoice',$this->is_invoice);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('status',$this->status,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('translation',$this->translation,true);
		$criteria->compare('user_id',$this->user_id);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
    protected function beforeSave()
    {
        if(parent::beforeSave())
        {
            $this->create_time = time();
            $this->user_id = Yii::app()->user->id;
            return true;
        }
        else
            return false;
    }
}
