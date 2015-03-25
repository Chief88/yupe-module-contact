<?php

class ContactController extends yupe\components\controllers\FrontController{

    public   $aliasModule = 'ContactModule.contact';
    
    public function actionShow($alias){

        $category = \Category::model()->findByAttributes( array('alias' => $alias));

        $criteria = new CDbCriteria();
        $criteria->with[] = 'category';
        $criteria->condition = 'category.alias = :alias';
        $criteria->params = array(
            ':alias' => $alias,
        );

        $contacts = Contact::model()->findAll($criteria);

        $this->render(
            'show',
            array(
                'contacts' => $contacts,
                'category' => $category,
                )
        );
    }

}
