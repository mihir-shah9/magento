<?php

class Ccc_Practice1_Block_Adminhtml_Practice1 extends
Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_practice1';
        $this->_blockGroup = 'practice1';
        $this->_headerText = Mage::helper('practice1')->__('Practice1 Manager');
        $this->_updateButton('add', 'label', Mage::helper('practice1')->__('Add Practice1'));
    }
}
