<?php

class Ccc_Order_Block_Adminhtml_Cart extends Mage_Adminhtml_Block_Widget_Form
{
    public function __construct()
    {
        parent::__construct();
        // $this->_mode = 'cart';
        $this->_controller = 'adminhtml_cart';
        $this->_blockGroup = 'order';
        $this->_headerText = Mage::helper('order')->__('Cart');
        $this->setTemplate('order/adminhtml/cart.phtml');
    }

    public function getHeader()
    {
        return Mage::helper('order')->__('Cart');
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
