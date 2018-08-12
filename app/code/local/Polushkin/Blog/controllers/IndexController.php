<?php

class Polushkin_Blog_IndexController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

//    public function viewAction()
//    {
//        $quote_id = (int)$this->getRequest()->getParam('request_id');
//        if (!$quote_id) {
//            $this->_forward('noRoute');
//        }
//        $this->loadLayout();
//        $this->getLayout()
//            ->getBlock('blog')
//            ->setBlockRequestId($quote_id);
//        $this->renderLayout();
//    }
    public function viewAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }

    public function postAction()
    {
        $this->loadLayout();
        $this->renderLayout();
    }
}