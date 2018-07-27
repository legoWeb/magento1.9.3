<?php

class Polushkin_TechTalk_Block_View extends Mage_Core_Block_Template
{
//    protected function _toHtml()
//    {
//        return "hello world";
//    }
    public function getRequestedRecord()
    {
        return Mage::getModel('techtalk/contact')->getCollection();
    }
}