<?php

class Polushkin_Blog_Adminhtml_PostController extends Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->_title($this->__('Post requests'))->_title($this->__('Post'));
        $this->loadLayout();
        $this->_setActiveMenu('cms/post');
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_post'));
        $this->renderLayout();
    }

    public function gridAction()
    {
        $this->loadLayout();
        $this->getResponse()->setBody(
            $this->getLayout()->createBlock('blog/adminhtml_post_grid')->toHtml()
        );
    }

    public function exportCsvAction()
    {
        $fileName = 'blog.csv';
        $grid = $this->getLayout()->createBlock('blog/adminhtml_post_grid');
        $this->_prepareDownloadResponse($fileName, $grid->getCsvFile());
    }

    public function exportExcelAction()
    {
        $fileName = 'blog.xml';
        $grid = $this->getLayout()->createBlock('blog/adminhtml_post_grid');
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
        $this->_title($this->__('Category Request'));

        // 1. Get ID and create model
        $id = $this->getRequest()->getParam('request_id');
        $model = Mage::getModel('blog/block');
        $modelobject = (array)Mage::getSingleton('adminhtml/session')->getModelobject(true);
        if (count($modelobject)) {
            Mage::registry('blog_block')->setData($modelobject);
        }
        // 2. Initial checking
        if ($id) {
            $model->load($id);
            if (!$model->getId()) {
                Mage::getSingleton('adminhtml/session')->addError(Mage::helper('blog')->__('This block no longer exists.'));
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
        Mage::register('post_request', $model);

        // 5. Build edit form
        $this->loadLayout();
        $this->_addContent($this->getLayout()->createBlock('blog/adminhtml_post_edit'));
        $this->_setActiveMenu('cms/post')
            ->_addBreadcrumb($id ? Mage::helper('blog')->__('Edit Request') : Mage::helper('blog')->__('New Request'), $id ? Mage::helper('blog')->__('Edit Request') : Mage::helper('blog')->__('New Request'))
            ->renderLayout();
    }

    public function saveAction()
    {
        try {
            $id = $this->getRequest()->getParam('request_id');
            $model = Mage::getModel('blog/block')->load($id);
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
        $model = Mage::getModel('blog/block')
            ->setId($this->getRequest()->getParam('request_id'))->delete();
        if ($model->getId()) {
            Mage::getSingleton('adminhtml/session')->addSuccess('Contact was delete');
        }
//        var_dump($model);die;
        $this->_redirect('*/*/');

    }

    /**
     * Check the permission to run it
     *
     * @return boolean
     */
    protected function _isAllowed()
    {
        return Mage::getSingleton('admin/session')->isAllowed('cms/post');
    }
}