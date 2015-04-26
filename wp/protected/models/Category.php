<?php
/**
 * Created by PhpStorm.
 * User: lkl
 * Date: 2015/4/12
 * Time: 22:03
 */
class Category extends CActiveRecord

{

    public static function model($className=__CLASS__)

    {
        parent::model($className);
    }

    public function tableName()
    {

        return 'co_category';

    }

    public function rules()
    {
        // NOTE: you should only define rules for those attributes that
        // will receive user inputs.
        return array(
            array('id', 'required'),
        );
    }

    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
        );
    }

    public function attributeLabels()
    {
        return array(
            'id' => 'ID',
            'name' => 'Name',

        );
    }

    public function search()
    {
        // @todo Please modify the following code to remove attributes that should not be searched.

        $criteria=new CDbCriteria;


        return new CActiveDataProvider($this, array(
            'criteria'=>$criteria,
        ));
    }
}