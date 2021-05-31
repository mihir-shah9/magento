<?php

class Ccc_Order_Adminhtml_OrderController extends
Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('order');
        $this->_addContent($this->getLayout()->createBlock('order/adminhtml_order'));
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('order');
        // $this->_addContent($this->getLayout()->createBlock('order/adminhtml_order_create'));
        $this->renderLayout();
    }

    public function oneAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('order');
        $this->renderLayout();
    }
}
