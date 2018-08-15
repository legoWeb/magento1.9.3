<?php

class Polushkin_Blog_Block_List extends Mage_Core_Block_Template
{
    public function getCategoryList()
    {
        return Mage::getModel('blog/category')->getCollection();
    }

    public function getList()
    {
        return Mage::getModel('blog/block')->getCollection();
    }

    public function getOneList()
    {
        $test = $this->getOneCategorylist()->getPostId();
        return Mage::getModel('blog/block')->load($test);
    }

    public function getOneCategorylist()
    {
        $postId = Mage::app()->getRequest()->getParam('post_id');
        return Mage::getModel('blog/category')->load($postId);
    }

    protected  function _prepareLayout()
    {
        parent::_prepareLayout();
        $pager = $this->getLayout()->createBlock('page/html_pager', 'custom.pager');
        $pager->setAvailableLimit(array(5=>5));
        $pager->setCollection($this->getList());

        $this->setChild('pager', $pager);

        return $this;
    }
    public function getPagerHtml()
    {
        return $this->getChildHtml('pager');
    }

}