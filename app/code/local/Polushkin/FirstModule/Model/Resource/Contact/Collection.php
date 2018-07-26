<?php

class Polushkin_FirstModule_Model_Resource_Contact_Collection extends Mage_Core_Model_Resource_Db_Collection_Abstract
{
    protected function _construct()
    {
        $this->_init('techtalk/contact');
    }
}