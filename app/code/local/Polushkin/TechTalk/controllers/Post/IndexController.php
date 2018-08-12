<?php

require_once Mage::getModuleDir('controllers', 'Mage_Contacts').DS.'IndexController.php';

class Polushkin_TechTalk_Post_IndexController extends Mage_Contacts_IndexController
{
 public function indexAction()
    {
        return $this->_redirect('noroute');
    }
}