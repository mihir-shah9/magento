<?php

class Ccc_Order_Block_Adminhtml_Cart_BillingAddress extends Mage_Core_Block_Template
{
    protected $cart;
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'order';
        $this->_controller = 'adminhtml_cart_index';
        $this->setTemplate('order/adminhtml/cart/billingAddress.phtml');
    }

    public function setCart(Ccc_Order_Model_Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cart) {
            throw new Exception("Cart Not Found.");
        }
        return $this->cart;
    }

    public function getBillingAddress()
    {

        $address = $this->getCart()->getBillingAddress();

        if ($address->getId()) {
            return $address;
        }

        $customerAddress = $this->getCart()->getCustomer()->getDefaultBillingAddress();

        if ($customerAddress == null) {
            return $address;
        }
        return $customerAddress;
    }

    public function getCountry()
    {
        return Mage::getModel('directory/country')->getCollection();
    }
}
