<?php
/**
 * This is the model class for table "Contact".
 *
 * The followings are the available columns in table 'Contact':
 * @property integer $id
 * @property string $data
 * @property integer $type_id
 */
class Contact extends yupe\models\YModel{

    /**
     * @return string the associated database table name
     */
    public function tableName()
    {
        return '{{contact_contact}}';
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
            'data'          => 'Контактная информация',
            'type_id'       => 'Тип контакта',
            'category_id'   => 'Категория',
            'name'          => 'Имя',
            'image'         => 'Картинка',
        ];
    }

    public function beforeValidate(){

        if(isset($this->contactType) && $this->contactType->validation != 'none'){
            $this->setScenario($this->contactType->validation);
        }

        return parent::beforeValidate();
    }

    /**
     * @return array validation rules for model attributes.
     */
    public function rules()
    {
        return [
            ['data, type_id', 'required'],
//            ['data', 'validatePhone', 'on'=>'phone'],
            ['data',
                'match',
                'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/',
                'message' => 'Неверный формат телефона',
                'on'=>'phone'
            ],
            ['data', 'email', 'on'=>'email'],
            ['image, name', 'length', 'max' => 250],
            ['category_id, data', 'numerical', 'integerOnly' => true, 'on'=>'integer'],
            ['image, name, category_id, data, type_id', 'safe'],
        ];
    }

    public function validatePhone($attribute){

        if(preg_match('/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/', $this->$attribute) == 0){
            $this->addError($attribute, 'Неверный формат телефона');
        }

    }

    public function behaviors()
    {
        $module = Yii::app()->getModule('contact');

        return [
            'imageUpload' => [
                'class'         => 'yupe\components\behaviors\ImageUploadBehavior',
                'attributeName' => 'image',
                'uploadPath'    => $module->uploadPath,
                'resizeOptions' => [
                    'width'   => 9999,
                    'height'  => 9999,
                    'quality' => [
                        'jpegQuality'         => 100,
                        'pngCompressionLevel' => 10
                    ],
                ],
                'defaultImage'   => $module->getAssetsUrl() . '/img/nophoto.jpg',
            ],
        ];
    }

    /**
     * @return array relational rules.
     */
    public function relations()
    {
        return [
            'category' => [self::BELONGS_TO, 'Category', 'category_id'],
            'contactType'  => [self::BELONGS_TO, 'ContactType', 'type_id'],
        ];
    }

    public function search()
    {
        $criteria = new CDbCriteria();

        $criteria->compare('id', $this->id);
        $criteria->compare('data', $this->data, true);
        $criteria->compare('type_id', $this->type_id);
        $criteria->compare('category_id', $this->category_id, true);
        $criteria->compare('name', $this->name, true);

        return new CActiveDataProvider(get_class($this), [
            'criteria' => $criteria,
        ]);
    }

    public function category($category_id){

        $this->getDbCriteria()->mergeWith(
            [
                'condition' => 'category_id = :category_id',
                'params'    => [':category_id' => $category_id],
            ]
        );

        return $this;
    }

    public function getAllPagesList($selfId = false)
    {
        $criteria = new CDbCriteria;
        $criteria->order = "{$this->tableAlias}.type_id DESC";
        if ($selfId) {
            $otherCriteria = new CDbCriteria;
            $otherCriteria->addNotInCondition('id', (array)$selfId);
            $otherCriteria->group = "{$this->tableAlias}.slug, {$this->tableAlias}.id";
            $criteria->mergeWith($otherCriteria);
        }
        return CHtml::listData($this->findAll($criteria), 'id', 'type_id');
    }

    public function getCategoryName()
    {
        return ($this->category === null) ? '---' : $this->category->name;
    }

} 