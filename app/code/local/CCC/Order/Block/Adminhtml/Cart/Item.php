<?php

class Ccc_Order_Block_Adminhtml_Cart_Item extends Mage_Core_Block_Template
{
    public function __construct()
    {
        parent::__construct();
        $this->_blockGroup = 'order';
        $this->_controller = 'adminhtml_cart_index';
        $this->setTemplate('order/adminhtml/cart/item.phtml');
    }

    public function setCart(Ccc_Order_Model_Cart $cart)
    {
        $this->cart = $cart;
        return $this;
    }

    public function getCart()
    {
        if (!$this->cart) {
            return false;
        }
        return $this->cart;
    }
}
