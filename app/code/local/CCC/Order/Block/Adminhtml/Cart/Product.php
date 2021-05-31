<?php

class Ccc_Order_Block_Adminhtml_Cart_Product extends Mage_Adminhtml_Block_Widget_Grid_Container
{
    // protected $product;
    public function __construct()
    {
        parent::__construct();
        $this->_removeButton('add');
        $this->_blockGroup = 'order';
        $this->_controller = 'adminhtml_cart_product';
        // $this->setTemplate('order/adminhtml/cart/product.phtml');
    }

    public function getHeaderText()
    {
        return Mage::helper('order')->__('Please Select Products to Add');
    }

    // public function __construct()
    // {
    //     parent::__construct();
    //     $this->setId('order_cart_product');
    // }


    // public function getButtonsHtml()
    // {
    //     $addButtonData = array(
    //         'label' => Mage::helper('order')->__('Add Selected Product(s) to Order'),
    //         'onclick' => 'order.productGridAddSelected()',
    //         'class' => 'add',
    //     );
    //     return $this->getLayout()->createBlock('adminhtml/widget_button')->setData($addButtonData)->toHtml();
    // }

    // public function getHeaderCssClass()
    // {
    //     return 'head-catalog-product';
    // }

    // public function getStore()
    // {
    //     return Mage::getSingleton('adminhtml/session_quote')->getStore();
    // }

    // public function getProduct()
    // {
    //     $attributes = Mage::getSingleton('catalog/config')->getProductAttributes();
    //     $collection = Mage::getModel('catalog/product')->getCollection();
    //     $collection
    //         ->setStore($this->getStore())
    //         ->addAttributeToSelect($attributes)
    //         ->addAttributeToSelect('sku')
    //         ->addStoreFilter()
    //         ->addAttributeToFilter('type_id', array_keys(
    //             Mage::getConfig()->getNode('adminhtml/sales/order/create/available_product_types')->asArray()
    //         ))
    //         ->addAttributeToSelect('gift_message_available');
    //     return $collection;
    // }

    // public function setCart(Ccc_Order_Model_Cart $cart)
    // {
    //     $this->cart = $cart;
    //     return $this;
    // }

    // public function getCart()
    // {
    //     if (!$this->cart) {
    //         return false;
    //     }
    //     return $this->cart;
    // }
}
