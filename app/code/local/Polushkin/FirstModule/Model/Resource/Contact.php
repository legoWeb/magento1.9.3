<?php

class Polushkin_FirstModule_Model_Resource_Contact extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('techtalk/contact', 'request_id');
    }
}