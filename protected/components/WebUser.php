<?php

class WebUser extends CWebUser {
    private $_model = null;

    /**
     * Returns user's role
     * @return array|mixed|null
     */
    function getRole() {
        if($user = $this->getModel()){
            return $user->role;
        }
    }

    /**
     * @return bool
     */
    function isAdmin(){
        if($this->getRole() == 'administrator')
            return true;
        else
            return false;
    }

    /**
     * Returns model
     * @return CActiveRecord|null
     */
    private function getModel(){
        if (!$this->isGuest && $this->_model === null){
            $this->_model = Users::model()->findByPk($this->id, array('select' => 'role'));
        }
        return $this->_model;
    }
}