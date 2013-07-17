<?php

/**
 * This is the model class for table "{{example}}".
 *
 * The followings are the available columns in table '{{example}}':
 * @property integer $id
 * @property string $title
 * @property string $code
 * @property string $original
 * @property string $translation
 * @property integer $position
 */
class Example extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @return Example the static model class
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
		return '{{example}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('title', 'required','message'=>'请输入标题'),
			array('code', 'required','message'=>'请输入英文标题'),
			array('original', 'required','message'=>'请输入原文'),
			array('translation', 'required','message'=>'请输入译文'),
			array('title', 'unique','message'=>'标题已经存在'),
            //array('title',  'match', 'pattern'=>'/^[\x7f-\xff]+$/','message'=>'标题必须为中文'),
			array('code', 'unique','message'=>'英文标题已经存在'),
            array('code',  'match', 'pattern'=>'/^[a-z]+$/','message'=>'英文标题必须为小写单词'),
			array('position', 'numerical', 'integerOnly'=>true),
			array('title, code', 'length', 'max'=>128),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, title, code, original, translation, position', 'safe', 'on'=>'search'),
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
			'id' => '自动编号',
			'title' => '标&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;题',
			'code' => '英&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文',
			'original' => '原&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文',
			'translation' => '译&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;文',
			'position' => '排&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;序',
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
		$criteria->compare('title',$this->title,true);
		$criteria->compare('code',$this->code,true);
		$criteria->compare('original',$this->original,true);
		$criteria->compare('translation',$this->translation,true);
		$criteria->compare('position',$this->position);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
}
