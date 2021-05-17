<?php

class Ccc_Vendor_Block_Account_Group extends Mage_Core_Block_Template
{

    public function __construct()
    {
        // parent::__construct();
        // $this->setTemplate('vendor/account/product.phtml');

        // $orders = Mage::getResourceModel('sales/order_collection')
        //     ->addFieldToSelect('*')
        //     ->addFieldToFilter('vendor_id', Mage::getSingleton('vendor/session')->getVendor()->getId())
        //     ->addFieldToFilter('state', array('in' => Mage::getSingleton('sales/order_config')->getVisibleOnFrontStates()))
        //     ->setOrder('created_at', 'desc');

        // $this->setOrders($orders);

        // Mage::app()->getFrontController()->getAction()->getLayout()->getBlock('root')->setHeaderTitle(Mage::helper('vendor')->__('My Orders'));
    }

    // protected function _prepareLayout()
    // {
    //     parent::_prepareLayout();

    //     $pager = $this->getLayout()->createBlock('page/html_pager', 'sales.order.history.pager')
    //         ->setCollection($this->getOrders());
    //     $this->setChild('pager', $pager);
    //     $this->getOrders()->load();
    //     return $this;
    // }

    // public function getPagerHtml()
    // {
    //     return $this->getChildHtml('pager');
    // }

    // public function getViewUrl($order)
    // {
    //     return $this->getUrl('*/*/view', array('order_id' => $order->getId()));
    // }

    // public function getTrackUrl($order)
    // {
    //     return $this->getUrl('*/*/track', array('order_id' => $order->getId()));
    // }

    // public function getReorderUrl($order)
    // {
    //     return $this->getUrl('*/*/reorder', array('order_id' => $order->getId()));
    // }

    // public function getBackUrl()
    // {
    //     return $this->getUrl('vendor/account/');
    // }
}
