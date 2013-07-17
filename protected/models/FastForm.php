<?php

class FastForm extends CActiveRecord
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
			array('original', 'required', 'message'=>'请输入翻译内容'),
			array('original', 'length', 'max'=>3000, 'tooLong'=>'文本长度过大，请您分段提交，或使用文档翻译'),
			//array('phone', 'required', 'message'=>'请输入电话号码'),
            array('phone', 'match','pattern' => '/^((0*\d{1,4}|\+\d{1,4}|\(\d{1,4}\))[ -]?)?(\d{2,4}[ -]?)?\d{3,4}[ -]?\d{3,4}([ -]\d{1,5})?$/','message' => '请输入正确的电话号码'),
			array('word_count, is_invoice, create_time, user_id', 'numerical', 'integerOnly'=>true),
			array('language, document, name, email, type, status', 'length', 'max'=>128),
			array('price', 'length', 'max'=>64),
			array('phone, qq', 'length', 'max'=>32),
			array('original, demand, translation', 'safe'),
			array('id, language, original, document, word_count, price, demand, name, phone, email, qq, is_invoice, type, status, create_time, translation, user_id', 'safe', 'on'=>'search'),
		);
	}

	public function relations()
	{
		return array(
            'user'=>array(self::BELONGS_TO, 'User', 'user_id'),
		);
	}

	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'language' => '选择语言：',
			'original' => '翻译内容：',
			'document' => 'Filename',
			'word_count' => 'Word Count',
			'price' => 'Price',
			'demand' => '需求备注：',
			'name' => 'Name',
			'phone' => '电话：',
			'email' => 'Email',
			'qq' => 'Qq',
			'is_invoice' => 'Is Invoice',
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

    public static function str_utf8_chinese_word_count($str = "")
    {
        $chinese =  "/[\x{4e00}-\x{9fff}\x{f900}-\x{faff}]/u";
        $symbol = "/[\x{ff00}-\x{ffef}\x{2000}-\x{206F}]/u";
        $str = preg_replace($symbol, "", $str);
        return preg_match_all($chinese, $str, $textrr);
    }

    public static function str_utf8_mix_word_count($str = "")
    {
        $chinese =  "/[\x{4e00}-\x{9fff}\x{f900}-\x{faff}]/u";
        $symbol = "/[\x{ff00}-\x{ffef}\x{2000}-\x{206F}]/u";
        $str = preg_replace($symbol, "", $str);
        return self::str_utf8_chinese_word_count($str) + str_word_count(preg_replace($chinese, "", $str));
    }

    public function getTranslateResult()
    {
        $dataProvider=new CActiveDataProvider('Translate', array(
    		'criteria'=>array(
        		'condition'=>'type="fast" and status="new" and user_id=' . Yii::app()->user->id,
        		'order'=>'create_time DESC',
    		),
    		'totalItemCount'=>10,
		));

        return $dataProvider;
    }

}
