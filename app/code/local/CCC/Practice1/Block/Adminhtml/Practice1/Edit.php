<?php

class Ccc_Practice1_Block_Adminhtml_Practice1_Edit extends
Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_objectId = 'id';
        $this->_controller = 'adminhtml_practice1';
        $this->_blockGroup = 'practice1';
        $this->_updateButton('save', 'label', Mage::helper('practice1')->__('Save Practice1'));
        $this->_updateButton('delete', 'label', Mage::helper('practice1')->__('Delete Practice1'));
    }

    public function getHeaderText()
    {
        if (Mage::registry('practice1_id')->getId()) {
            return Mage::helper('practice1')->__('Edit Practice1');
        }
        return Mage::helper('practice1')->__('Add Practice1');
    }
}
