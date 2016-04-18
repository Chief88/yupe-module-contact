<?php

Yii::import('application.modules.menu.models.*');

class ContactBackendController extends yupe\components\controllers\BackController
{
	private $_model;

	public $aliasModule = 'ContactModule.contact';
	public $patchBackend = '/contact/contactBackend/';

	public function accessRules()
	{
		return [
			['allow', 'roles' => ['admin']],
			['allow', 'actions' => ['index'], 'roles' => ['Contact.ContactBackend.Index']],
			['allow', 'actions' => ['create'], 'roles' => ['Contact.ContactBackend.Create']],
			['allow', 'actions' => ['update'], 'roles' => ['Contact.ContactBackend.Update']],
			['allow', 'actions' => ['delete', 'multiaction'], 'roles' => ['Contact.ContactBackend.Delete']],
			['deny']
		];
	}

	public function actionIndex()
	{
		$model = new Contact('search');

		$model->unsetAttributes();

		$model->setAttributes(
			Yii::app()->getRequest()->getParam(
				'Contact', array()
			)
		);

		$this->render(
			'index', array(
				'model' => $model,
				'pages' => Contact::model()->getAllPagesList(),
			)
		);
	}

	public function actionCreate()
	{
		$model = new Contact;

		if (isset($_POST['Contact'])) {
			$model->attributes = $_POST['Contact'];
			if ($model->validate()) {
				$model->save();

				$this->redirect(
					(array)Yii::app()->getRequest()->getPost(
						'submit-type',
						array('create')
					)
				);
			}
		}

		$languages = $this->yupe->getLanguagesList();

		//если добавляем перевод
		$id = (int)Yii::app()->getRequest()->getQuery('id');
		$lang = Yii::app()->getRequest()->getQuery('lang');

		if (!empty($id) && !empty($lang)) {
			$contact = Contact::model()->findByPk($id);

			if (null === $contact) {
				Yii::app()->user->setFlash(
					yupe\widgets\YFlashMessages::ERROR_MESSAGE,
					Yii::t($this->aliasModule, 'Targeting contact was not found!')
				);
				$this->redirect(['create']);
			}

			if (!array_key_exists($lang, $languages)) {
				Yii::app()->user->setFlash(
					yupe\widgets\YFlashMessages::ERROR_MESSAGE,
					Yii::t($this->aliasModule, 'Language was not found!')
				);

				$this->redirect(['create']);
			}

			Yii::app()->user->setFlash(
				yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
				Yii::t(
					$this->aliasModule,
					'You are adding translate in to {lang}!',
					[
						'{lang}' => $languages[$lang]
					]
				)
			);

			$model->lang = $lang;
			$model->type_id = $contact->type_id;
			$model->category_id = $contact->category_id;
			$model->name = $contact->name;
		} else {
			$model->lang = Yii::app()->language;
		}

		$this->render(
			'create', array(
				'model' => $model,
				'languages' => $languages
			)
		);
	}

	public function actionUpdate($id)
	{

		// Указан ID страницы, редактируем только ее
		$model = $this->loadModel($id);

		$oldTitle = $model->type_id;
		$menuId = null;
		$menuParentId = 0;

		if (($data = Yii::app()->getRequest()->getPost('Contact')) !== null) {

			$model->setAttributes($data);

			if ($model->save()) {

				Yii::app()->user->setFlash(
					yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
					Yii::t($this->aliasModule, 'Контакты обновлены!')
				);

				$this->redirect(
					(array)Yii::app()->getRequest()->getPost(
						'submit-type', array('update', 'id' => $model->id)
					)
				);
			}
		}

		if (Yii::app()->hasModule('menu')) {

			$menuItem = MenuItem::model()->findByAttributes(
				array(
					"title" => $oldTitle
				)
			);

			if ($menuItem !== null) {
				$menuId = (int)$menuItem->menu_id;
				$menuParentId = (int)$menuItem->parent_id;
			}
		}

		$this->render(
			'update', array(
				'model' => $model,
				'menuId' => $menuId,
				'menuParentId' => $menuParentId,
				'languages' => $this->yupe->getLanguagesList()
			)
		);

	}

	public function actionDelete($id = null)
	{
		if (Yii::app()->getRequest()->getIsPostRequest()) {

			$model = $this->loadModel($id);

			// we only allow deletion via POST request
			$model->delete();

			Yii::app()->user->setFlash(
				yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
				Yii::t($this->aliasModule, 'Контакты успешно удалены!')
			);

			// если это AJAX запрос ( кликнули удаление в админском grid view), мы не должны никуда редиректить
			Yii::app()->getRequest()->getParam('ajax') !== null || $this->redirect(
				(array)Yii::app()->getRequest()->getPost('returnUrl', 'index')
			);
		} else {
			throw new CHttpException(
				404,
				Yii::t($this->aliasModule, 'Bad request. Please don\'t repeat similar requests anymore!')
			);
		}
	}

	public function loadModel($id)
	{
		if ($this->_model === null || $this->_model->id !== $id) {

			if (($this->_model = Contact::model()->findByPk($id)) === null) {
				throw new CHttpException(
					404,
					Yii::t($this->aliasModule, 'Page was not found')
				);
			}
		}

		return $this->_model;
	}

}