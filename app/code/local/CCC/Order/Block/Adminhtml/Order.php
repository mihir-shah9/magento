<?php

class Ccc_Order_Block_Adminhtml_Order extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    public function __construct()
    {
        parent::__construct();
        $this->_controller = 'adminhtml_order';
        $this->_blockGroup = 'order';
        $this->_headerText = Mage::helper('order')->__('Orders');
        $this->_updateButton('add', 'label', Mage::helper('order')->__('Create New Order'));
    }
}
