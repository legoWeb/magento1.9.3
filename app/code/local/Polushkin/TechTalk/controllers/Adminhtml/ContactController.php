<?php

class Polushkin_TechTalk_Adminhtml_ContactController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Contact requests'))->_title($this->__('Contact'));
        $this->loadLayout();
        $this->_setActiveMenu('cms/contact');
        $this->_addContent($this->getLayout()->createBlock('techtalk/adminhtml_contact'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('techtalk/adminhtml_contact_grid')->toHtml()
        );
    }

    public function exportCsvAction()
    {
        $fileName = 'contacts.csv';
        $grid = $this->getLayout()->createBlock('techtalk/adminhtml_contact_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportExcelAction()
    {
        $fileName = 'contacts.xml';
        $grid = $this->getLayout()->createBlock('techtalk/adminhtml_contact_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getExcelFile($fileName));
    }

    // edit section

    public function newAction()
    {
        // the same form is used to create and edit
        $this->_forward('edit');
    }

    public function editAction()
    {
        $this->_title($this->__('Contact Request'));

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('request_id');
        $model = Mage::getModel('techtalk/contact');
        $modelobject = (array)Mage::getSingleton('adminhtml/session')->getModelobject(true);
        if (count($modelobject)) {
            Mage::registry('techtalk_block')->setData($modelobject);
        }
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('techtalk')->__('This block no longer exists.'));
                $this->_redirect('*/*/');
                return;
            }
        }

        $this->_title($model->getId() ? $model->getTitle() : $this->__('New Request'));

        // 3. Set entered data if there is an error when we've saved it
        $data = Mage::getSingleton('adminhtml/session')->getFormData(true);
        if (!empty($data)) {
            $model->setData($data);
        }

        // 4. Register model to use later in blocks
        Mage::register('contact_request', $model);

        // 5. Build edit form
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('techtalk/adminhtml_contact_edit'));
        $this->_setActiveMenu('cms/contacts')
            ->_addBreadcrumb($id ? Mage::helper('techtalk')->__('Edit Request') : Mage::helper('techtalk')->__('New Request'), $id ? Mage::helper('techtalk')->__('Edit Request') : Mage::helper('techtalk')->__('New Request'))
            ->renderLayout();
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('request_id');
            $model = Mage::getModel('techtalk/contact')->load($id);
            $model->setData($this->getRequest()->getParams())->save();

            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError('Cannot save this Block');
        }
        } catch (Exception $e) {
            Mage::logException($e);
            Mage::getSingleton('adminhtml/session')->addError($e->getMessage());
            Mage::getSingleton('adminhtml/session')->setModelobject($model->setData());
        }

        Mage::getSingleton('adminhtml/session')->addSuccess('Contact was saved succesfully');

        $this->_redirect('*/*/'.$this->getRequest()->getParam('back', 'index'),
            array('request_id'=> $model->getId()));
    }


    public function deleteAction()
    {
        $model = Mage::getModel('techtalk/contact')
           ->setId($this->getRequest()->getParam('request_id'))->delete();
        if ($model->getId()) {
            Mage::getSingleton('adminhtml')->addSuccess('Contact was delete');
        }
        $this->_redirect('*/*/');
//        var_dump($model);die;
    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/contact');
    }
}