<?php

Yii::import('application.modules.menu.models.*');

class ContactTypeBackendController extends yupe\components\controllers\BackController
{
    private $_model;

    public   $aliasModule = 'ContactModule.contact';
    public   $patchBackend = '/contact/contactTypeBackend/';

	public function actionIndex(){
        $model = new ContactType('search');

        $model->unsetAttributes();

        $model->setAttributes(
            Yii::app()->getRequest()->getParam(
                'ContactType', []
            )
        );

        $this->render(
            'index', [
                'model' => $model,
                'pages' => ContactType::model()->getAllPagesList(),
            ]
        );
	}

    public function actionCreate(){

        $model = new ContactType();

        if (($data = Yii::app()->getRequest()->getPost('ContactType')) !== null) {
            $model->setAttributes($data);

                if ($model->save()) {

                    Yii::app()->user->setFlash(
                        yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                        Yii::t($this->aliasModule, 'Тип контакта создан!')
                    );

                    $this->redirect(
                        (array)Yii::app()->getRequest()->getPost(
                            'submit-type',
                            ['create']
                        )
                    );
                }

        }

        $this->render('create', [
            'model' => $model,
        ]);

	}

    public function actionUpdate($id){

        // Указан ID страницы, редактируем только ее
        $model = $this->loadModel($id);

        $oldTitle     = $model->name;
        $menuId       = null;
        $menuParentId = 0;

        if (($data = Yii::app()->getRequest()->getPost('ContactType')) !== null) {

            $model->setAttributes($data);

            if ($model->save()) {

                Yii::app()->user->setFlash(
                    yupe\widgets\YFlashMessages::SUCCESS_MESSAGE,
                    Yii::t($this->aliasModule, 'Контакты обновлены!')
                );

                $this->redirect(
                    (array) Yii::app()->getRequest()->getPost(
                        'submit-type', ['update', 'id' => $model->id]
                    )
                );
            }
        }

        if (Yii::app()->hasModule('menu')) {

            $menuItem = MenuItem::model()->findByAttributes(
                [
                    "title"=>$oldTitle
                ]
            );

            if ($menuItem !== null) {
                $menuId       = (int)$menuItem->menu_id;
                $menuParentId = (int)$menuItem->parent_id;
            }
        }

        $this->render(
            'update', [
                'model'        => $model,
                'menuId'       =>$menuId,
                'menuParentId' =>$menuParentId
            ]
        );

    }

    public function actionDelete($id = null){
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
                (array) Yii::app()->getRequest()->getPost('returnUrl', 'index')
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

            if (($this->_model = ContactType::model()->findByPk($id)) === null) {
                throw new CHttpException(
                    404,
                    Yii::t($this->aliasModule, 'Page was not found')
                );
            }
        }

        return $this->_model;
    }

}