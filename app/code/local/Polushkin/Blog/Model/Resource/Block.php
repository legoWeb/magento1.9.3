<?php

class Polushkin_Blog_Model_Resource_Block extends Mage_Core_Model_Resource_Db_Abstract
{
    protected function _construct()
    {
        $this->_init('blog/block', 'request_id');
    }
}