<?php

class ContactType extends yupe\models\YModel{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{contact_type}}';
    }

    /**
     * Returns the static model of the specified AR class.
     *
     * @return User the static model class
     */
    public static function model($className = __CLASS__)
    {
        return parent::model($className);
    }

    /**
     * @return array customized attribute labels (name=>label)
     */
    public function attributeLabels()
    {
        return [
            'name'              => 'Название типа контакта',
            'nameEn'            => 'Название типа контакта (En)',
            'validation'        => 'Тип валидации',
        ];
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['name, nameEn, validation', 'required'],
            ['name, nameEn, validation', 'length', 'max' => 150],
            ['name, nameEn, validation', 'safe'],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'contact'  => [self::BELONGS_TO, 'Contact', 'id'],
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('name', $this->name, true);
        $criteria->compare('validation', $this->validation, true);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
        ]);
    }

    public function getAllPagesList($selfId = false)
    {
        $criteria = new CDbCriteria;
        $criteria->order = "{$this->tableAlias}.name DESC";
        if ($selfId) {
            $otherCriteria = new CDbCriteria;
            $otherCriteria->addNotInCondition('id', (array)$selfId);
            $otherCriteria->group = "{$this->tableAlias}.slug, {$this->tableAlias}.id";
            $criteria->mergeWith($otherCriteria);
        }
        return CHtml::listData($this->findAll($criteria), 'id', 'name');
    }

    public function getListNameType(){
        return CHtml::listData($this->model()->findAll(), 'id', 'name');
    }

    public function getListValidates(){
        return CHtml::listData(
            Yii::app()->getModule('contact')->validates,
            'type',
            'title'
        );
    }

    public function  getTitleValidation(){
        $aValidates = Yii::app()->getModule('contact')->validates;
        foreach($aValidates as $validate){
            if($validate['type'] == $this->validation){
                return $validate['title'];
            }
        }

        return;
    }

    public function getListTypeContact(){
        return CHtml::listData(
            $this->model()->findAll(),
            'id',
            'name'
        );
    }

}