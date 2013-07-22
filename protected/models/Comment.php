<?php

/**
 * This is the model class for table "{{comment}}".
 *
 * The followings are the available columns in table '{{comment}}':
 * @property integer $id
 * @property integer $level
 * @property string $type
 * @property string $content
 * @property integer $create_time
 * @property integer $translate_id
 */
class Comment extends CActiveRecord
{
	/**
	 * Returns the static model of the specified AR class.
	 * @param string $className active record class name.
	 * @return Comment the static model class
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
		return '{{comment}}';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('translate_id', 'required'),
			array('level, create_time, translate_id', 'numerical', 'integerOnly'=>true),
			array('type', 'length', 'max'=>32),
			array('content, level', 'safe'),
			// The following rule is used by search().
			// Please remove those attributes that should not be searched.
			array('id, level, type, content, create_time, translate_id', 'safe', 'on'=>'search'),
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
            'translate' => array(self::HAS_ONE, 'Translate', 'translate_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'level' => '您对本次订单满意吗',
			'type' => '选择反馈类别',
			'content' => '反馈内容',
			'create_time' => '提交时间',
			'translate_id' => '订单号',
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
		$criteria->compare('level',$this->level, true);
		$criteria->compare('type',$this->type,true);
		$criteria->compare('content',$this->content,true);
		$criteria->compare('create_time',$this->create_time);
		$criteria->compare('translate_id',$this->translate_id);
        #$criteria->addCondition('translate_id!=""');

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
            'sort'=>array(
			    'defaultOrder'=>'create_time DESC',
            ),
		));
	}
}
