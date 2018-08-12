<?php

class Polushkin_Blog_Block_Post extends Mage_Core_Block_Template
{
    public function getList()
    {
        return Mage::getModel('blog/category')->load(1);
    }

}