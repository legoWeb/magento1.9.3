<?php

class Polushkin_Blog_Block_View extends Mage_Core_Block_Template
{
    public function getOneList()
    {
        $postId = Mage::getModel('block/category', 'post_id');
        return Mage::getModel('blog/block')->load($postId);
    }

    public function getOneCategorylist()
    {
        $postId = Mage::app()->getRequest()->getParam('post_id');
        return Mage::getModel('blog/category')->load($postId);
    }

}