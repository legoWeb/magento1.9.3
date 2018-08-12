<?php

class Polushkin_Blog_Block_View extends Mage_Core_Block_Template
{
    public function getList()
    {
        return Mage::getModel('blog/block')->load(1);
    }

    public function getCategorylist()
    {
        return Mage::getModel('blog/category')->load(1);
    }

}