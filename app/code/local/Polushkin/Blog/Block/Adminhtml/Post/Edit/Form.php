<?php

class Polushkin_Blog_Block_Adminhtml_Post_Edit_Form extends Mage_Adminhtml_Block_Widget_Form
{
    /**
     * Init form
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('post_request');
        $this->setTitle(Mage::helper('blog')->__('Request info'));
    }

    /**
     * Load Wysiwyg on demand and Prepare layout
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();
        if (Mage::getSingleton('cms/wysiwyg_config')->isEnabled()) {
            $this->getLayout()->getBlock('head')->setCanLoadTinyMce(true);
        }
    }

    protected function _prepareForm()
    {
        $model = Mage::registry('post_request');

        $form = new Varien_Data_Form(
            ['id' => 'edit_form',
                'action' => $this->getUrl('*/*/save', array('request_id' => $this->getRequest()->getParam('request_id'))),
                'method' => 'post']
        );

        $form->setHtmlIdPrefix('block_');

        $fieldset = $form->addFieldset('base_fieldset', [
            'legend' => Mage::helper('blog')->__('General Information'),
            'class' => 'fieldset-wide'
        ]);

        if ($model->getBlockId()) {
            $fieldset->addField('request_id', 'hidden', [
                'name' => 'request_id',
            ]);
        }

        $fieldset->addField('name', 'text', [
            'name'     => 'name',
            'label'    => Mage::helper('blog')->__('Contact Name'),
            'title'    => Mage::helper('blog')->__('Contact Name'),
            'required' => true,
        ]);

        $fieldset->addField('short_description', 'editor', [
            'name'     => 'short_description',
            'label'    => Mage::helper('blog')->__('Comment'),
            'title'    => Mage::helper('blog')->__('Comment'),
            'style'    => 'height:36em',
            'required' => true,
            'config'   => Mage::getSingleton('cms/wysiwyg_config')->getConfig(),
        ]);

        $form->setValues($model->getData());
        $form->setUseContainer(true);
        $this->setForm($form);

        return parent::_prepareForm();
    }

}