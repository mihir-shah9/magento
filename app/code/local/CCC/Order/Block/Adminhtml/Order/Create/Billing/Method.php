<?php

class Ccc_Order_Block_Adminhtml_Order_Create_Billing_Method extends Mage_Adminhtml_Block_Sales_Order_Create_Abstract
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('order_create_billing_method');
    }

    public function getHeaderText()
    {
        return Mage::helper('order')->__('Payment Method');
    }

    public function getHeaderCssClass()
    {
        return 'head-payment-method';
    }
}
