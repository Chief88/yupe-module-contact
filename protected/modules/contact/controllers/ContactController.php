<?php

class ContactController extends yupe\components\controllers\FrontController{

    public   $aliasModule = 'ContactModule.contact';

    public function actionIndex(){

        $categoryModel = '';
        if (\Yii::app()->hasModule('category')) {
            $categoryModel = \Category::model()->findByAttributes(['slug' => 'stranica-kontakty']);
        }

        $this->render('index', [
            'categoryModel' => $categoryModel,
        ]);
    }
    
    public function actionShow($alias){

        $category = \Category::model()->findByAttributes( ['alias' => $alias]);

        $criteria = new CDbCriteria();
        $criteria->with[] = 'category';
        $criteria->condition = 'category.alias = :alias';
        $criteria->params = [
            ':alias' => $alias,
        ];

        $contacts = Contact::model()->findAll($criteria);

        $this->render('show', [
                'contacts' => $contacts,
                'category' => $category,
            ]
        );
    }

}
