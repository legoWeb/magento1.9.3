<?php

class Polushkin_FirstModule_Block_View extends Mage_Core_Block_Template
{
    public function getRequestedRecord()
    {
        return Mage::getModel('techtalk/contact')->getCollection();
    }

}