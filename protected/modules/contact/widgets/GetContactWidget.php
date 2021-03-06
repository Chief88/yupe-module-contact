<?php
Yii::import('application.modules.contact.models.Contact');

class GetContactWidget extends yupe\widgets\YWidget
{

	public $nameContact;
	public $view = 'listContacts';
	public $itemDelimiter = ',';
	public $categoryId;
	public $limit = false;
	public $params = [];

	public function init()
	{

	}

	public function run()
	{

		$criteria = new CDbCriteria();
		$criteria->with[] = 'contactType';
		if (empty($this->categoryId)) {
			$criteria->condition = 'contactType.name = :name';
			$criteria->params = [
				':name' => $this->nameContact,
			];
		} else {
			$criteria->with[] = 'category';
			if ($this->categoryId == 'all') {
				$criteria->condition = 't.category_id != :categoryId';
				$criteria->params = [
					':categoryId' => 'NULL',
				];
			} else {
				$criteria->condition = 'contactType.name = :name AND category.id = :categoryId';
				$criteria->params = [
					':name' => $this->nameContact,
					':categoryId' => $this->categoryId,
				];
			}
		}

		if ($this->limit) {
			$criteria->limit = $this->limit;
		}

		$mainCondition = $criteria->condition;
		$mainParams = $criteria->params;
		if($this->controller->isMultilang()){
			$criteria->addInCondition('t.lang', [Yii::app()->language]);
		}

		$contacts = Contact::model()->findAll($criteria);

		if(count($contacts) == 0){
			if($this->controller->isMultilang()){
				$criteria->condition = $mainCondition;
				$criteria->params = $mainParams;
				$criteria->addInCondition('t.lang', [$this->controller->yupe->defaultLanguage]);
				$contacts = Contact::model()->findAll($criteria);
			}
		}

		$this->render($this->view, [
			'contacts' => $contacts,
			'itemDelimiter' => $this->itemDelimiter,
			'params' => $this->params
		]);

	}
}