<?php

/**
 * This is the model class for table "Contact".
 *
 * The followings are the available columns in table 'Contact':
 * @property integer $id
 * @property string $data
 * @property integer $type_id
 * @property integer $category_id
 * @property string $lang
 * @property string $name
 * @property string $image
 */
class Contact extends yupe\models\YModel
{

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
			'data' => 'Контактная информация',
			'type_id' => 'Тип контакта',
			'category_id' => 'Категория',
			'name' => 'Имя',
			'image' => 'Картинка',
			'lang' => Yii::t('ContactModule.contact', 'Language'),
		];
	}

	/**
	 * @return bool
	 */
	public function beforeValidate()
	{
		if (!$this->lang) {
			$this->lang = Yii::app()->language;
		}

		if (isset($this->contactType) && $this->contactType->validation != 'none') {
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
			['data, type_id, lang', 'required'],
			['data',
				'match',
				'pattern' => '/^((8|\+7)[\- ]?)?(\(?\d{3,4}\)?[\- ]?)?[\d\- ]{5,10}$/',
				'message' => 'Неверный формат телефона',
				'on' => 'phone'
			],
			['data', 'email', 'on' => 'email'],
			['image, name', 'length', 'max' => 250],
			['lang', 'length', 'max' => 2],
			['category_id, data', 'numerical', 'integerOnly' => true, 'on' => 'integer'],
			['lang, image, name, category_id, data, type_id', 'safe'],
		];
	}

	/**
	 * @return array
	 */
	public function behaviors()
	{
		$module = Yii::app()->getModule('contact');

		return [
			'imageUpload' => [
				'class' => 'yupe\components\behaviors\ImageUploadBehavior',
				'attributeName' => 'image',
				'uploadPath' => $module->uploadPath,
				'resizeOptions' => [
					'width' => 9999,
					'height' => 9999,
					'quality' => [
						'jpegQuality' => 100,
						'pngCompressionLevel' => 9
					],
				],
				'defaultImage' => $module->getAssetsUrl() . '/img/nophoto.jpg',
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
			'contactType' => [self::BELONGS_TO, 'ContactType', 'type_id'],
		];
	}

	/**
	 * @return CActiveDataProvider
	 */
	public function search()
	{
		$criteria = new CDbCriteria();

		$criteria->compare('id', $this->id);
		$criteria->compare('data', $this->data, true);
		$criteria->compare('type_id', $this->type_id);
		$criteria->compare('category_id', $this->category_id, true);
		$criteria->compare('name', $this->name, true);
		$criteria->compare('lang', $this->lang);

		return new CActiveDataProvider(get_class($this), [
			'criteria' => $criteria,
		]);
	}

	/**
	 * @param $category_id
	 * @return $this
	 */
	public function category($category_id)
	{

		$this->getDbCriteria()->mergeWith(
			[
				'condition' => 'category_id = :category_id',
				'params' => [':category_id' => $category_id],
			]
		);

		return $this;
	}

	/**
	 * @param bool $selfId
	 * @return array
	 */
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

	/**
	 * @return string
	 */
	public function getCategoryName()
	{
		return ($this->category === null) ? '---' : '[' . $this->category->id . '] ' . $this->category->name;
	}

//	/**
//	 * @param $lang
//	 * @return $this
//	 */
//	public function language($lang)
//	{
//		$this->getDbCriteria()->mergeWith(
//			[
//				'condition' => 'lang = :lang',
//				'params'    => [':lang' => $lang],
//			]
//		);
//
//		return $this;
//	}

} 