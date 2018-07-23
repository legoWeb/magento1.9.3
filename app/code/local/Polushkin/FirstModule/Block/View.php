<?php

class Polushkin_FirstModule_Block_View extends Mage_Core_Block_Template
{
    protected function getRequestedRecord()
    {
        return Mage::getModel('helloword/contact')->load('1');
    }
}