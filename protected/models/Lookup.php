<?php

/**
 * This is the model class for table "{{lookup}}".
 *
 * The followings are the available columns in table '{{lookup}}':
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $type
 * @property integer $position
 */
class Lookup extends CActiveRecord
{

    private static $_items = array();

	/**
	 * Returns the static model of the specified AR class.
	 * @return Lookup the static model class
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
		return '{{lookup}}';
	}

    public static function items($type, $code="")
    {
        if(!isset(self::$_items[$type]))
            self::loadItems($type, $code);

        return self::$_items[$type];
    }

    public static function radioItems($type, $code="")
    {
        self::$_items[$type] = array();
        if(empty($code))
        {
            $models = self::model()->findAll(array(
                'condition' => 'type=:type',
                'params' => array(':type' => $type),
                'order' => 'position',
            ));
        } else
        {
            $models = self::model()->findAll(array(
                'condition' => 'type=:type and code=:code',
                'params' => array(':type' => $type, ':code' => $code),
                'order' => 'position',
            ));
        }
        foreach($models as $model)
            $radioList[$model->code] = "";
        return $radioList;
    }


    public static function item($type, $code)
    {
        if(!isset(self::$_items[$type]))
            self::loadItems($type);

        return isset(self::$_items[$type][$code]) ? self::$_items[$type][$code] : false;
    }

    private static function loadItems($type, $code="")
    {
        self::$_items[$type] = array();
        if(empty($code))
        {
            $models = self::model()->findAll(array(
                'condition' => 'type=:type',
                'params' => array(':type' => $type),
                'order' => 'position',
            ));
        } else
        {
            $models = self::model()->findAll(array(
                'condition' => 'type=:type and code=:code',
                'params' => array(':type' => $type, ':code' => $code),
                'order' => 'position',
            ));
        }
        foreach($models as $model)
            self::$_items[$type][$model->code] = $model->name;
    }

}
