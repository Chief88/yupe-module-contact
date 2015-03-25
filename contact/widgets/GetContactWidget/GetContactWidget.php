<?php
Yii::import('application.modules.contact.models.Contact');
class GetContactWidget extends CWidget{

    public $nameContact;
    public $view = 'listContacts';

    public function init(){

    }

    public function run(){

        $criteria = new CDbCriteria();
        $criteria->with[] = 'contactType';
        $criteria->condition = 'contactType.name = :name';
        $criteria->params = array(
            ':name' => $this->nameContact,
        );

        $contacts = Contact::model()->findAll($criteria);

        $this->render('//'.$this->view, array(
            'contacts' => $contacts,
        ));

    }
}