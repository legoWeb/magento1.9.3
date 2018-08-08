<?php

class Polushkin_Blog_Model_Category extends Mage_Core_Model_Abstract
{
    public function _construct()
    {
        $this->_init('blog/category');
    }
}