<?php
Yii::import('application.modules.contact.models.Contact');
class GetContactWidget extends yupe\widgets\YWidget{

    public $nameContact;
    public $view = 'listContacts';
    public $itemDelimiter = ',';
    public $categoryId;

    public function init(){

    }

    public function run(){

        $criteria = new CDbCriteria();
        $criteria->with[] = 'contactType';
        if( empty($this->categoryId) ){
            $criteria->condition = 'contactType.name = :name';
            $criteria->params = array(
                ':name' => $this->nameContact,
            );
        }else{
            $criteria->with[] = 'category';
            $criteria->condition = 'contactType.name = :name AND category.id = :categoryId';
            $criteria->params = array(
                ':name' => $this->nameContact,
                ':categoryId' => $this->categoryId,
            );
        }

        $contacts = Contact::model()->findAll($criteria);

        $this->render($this->view, array(
            'contacts' => $contacts,
            'itemDelimiter' => $this->itemDelimiter,
        ));

    }
}