<?php

class Ccc_Order_Block_Adminhtml_Order_Create_Customer extends Mage_Adminhtml_Block_Sales_Order_Create_Abstract
{

    public function __construct()
    {
        parent::__construct();
        $this->setId('order_create_customer');
    }

    public function getHeaderText()
    {
        return Mage::helper('order')->__('Please Select a Customer');
    }

    // public function getButtonsHtml()
    // {
    //     $addButtonData = array(
    //         'label'     => Mage::helper('order')->__('Create New Customer'),
    //         'onclick'   => 'order.setCustomerId(false)',
    //         'class'     => 'add',
    //     );
    //     return $this->getLayout()->createBlock('adminhtml/widget_button')->setData($addButtonData)->toHtml();
    // }
}
