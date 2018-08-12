<?php

class Polushkin_Blog_Block_List extends Mage_Core_Block_Template
{
    public function getList()
    {
        return Mage::getModel('blog/block')->getCollection();
    }

    public function getCategoryList()
    {
        return Mage::getModel('blog/category')->getCollection();
    }
}