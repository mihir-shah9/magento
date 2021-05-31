<?php

class Ccc_Order_Adminhtml_CartController extends
Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        try {
            $this->loadLayout();
            $cart = $this->_getCart();
            $block = $this->getLayout()->getBlock('cart');
            $block->setCart($cart);
            $this->_setActiveMenu('order');
            $this->renderLayout();
        } catch (Exception $e) {
            $this->_getSession()->addError(Mage::helper('order')->__($e->getMessage()));
        }
    }

    public function startAction()
    {
        $this->_initSession();
        $this->_getCart();
        $this->_redirect('*/*/index');
    }

    protected function _initSession()
    {
        $customerId = $this->getRequest()->getParam('id');
        $session = Mage::getModel('order/session');
        $session->setCustomerId($customerId);
    }

    protected function _getCart()
    {
        $customerId = Mage::getModel('order/session')->getCustomerId();
        $customer = Mage::getModel('customer/customer')->load($customerId);
        if (!$customer->getId()) {
            throw new Exception("Customer Not Found.");
        }

        $cart = Mage::getModel('order/cart')->load($customerId, 'customer_id');
        if ($cart->getId()) {
            return $cart;
        }
        $cart->customer_id = $customerId;
        $cart->created_at = date('Y-m-d H:i:s');
        $cart->save();
        return $cart;
    }

    // public function saveAction()
    // {
    //     $productIds = $this->getRequest()->getPost('product');
    //     if (!$productIds) {
    //         $this->_redirect('*/*/');
    //     }

    //     $cartModel = Mage::getModel('order/cart');
    //     $cartModel->addItemToCart($productIds);

    //     print_r($cartModel);
    //     die;
    //     // $product = Mage::getModel('catalog/product')->load($productIds);
    //     // if ($product) {
    //     //     $this->_getCart()->addItemToCart($product);
    //     //     // return $this;
    //     // }
    // }

    public function saveBillingAddressAction()
    {
        try {
            $cart = $this->_getCart();
            $address = $this->getRequest()->getPost('order');

            $billingAddress = $cart->getBillingAddress();
            $billingAddress->addData($address['billing_address']);
            $billingAddress->setCartId($cart->getId());
            $billingAddress->setStreet($address['billing_address']['street']);
            $billingAddress->setCustomerId($cart->getCustomer()->getId());
            $billingAddress->setAddressType('billing');
            $billingAddress->setCreatedAt(date('Y-m-d H:i:s'));
            $billingAddress->save();


            $saveInAddress = $this->getRequest()->getPost('save_in_address_book');
            if ($saveInAddress) {
                $billingAddress = $cart->getCustomer()->getBillingAddress();
                $cartBillingAddress = $cart->getBillingAddress()->getData();
                unset($cartBillingAddress['address_id']);
                unset($cartBillingAddress['cart_id']);
                $billingAddress->addData($cartBillingAddress);
                $billingAddress->setParentId($cart->getCustomerId());
                $billingAddress->setIsDefaultBilling('1');
                $billingAddress->setSaveInAddressBook('1');
                $billingAddress->save();
            }
            $this->_redirect('*/*/');
        } catch (Exception $e) {
            $this->_getSession()->addError(Mage::helper('order')->__($e->getMessage()));
        }
    }

    public function saveShippingAddressAction()
    {
        try {
            $cart = $this->_getCart();
            $address = $this->getRequest()->getPost('order');

            $shippingAddress = $cart->getShippingAddress();
            $shippingAddress->addData($address['shipping_address']);
            $shippingAddress->setCartId($cart->getId());
            $shippingAddress->setStreet($address['shipping_address']['street']);
            $shippingAddress->setCustomerId($cart->getCustomer()->getId());
            $shippingAddress->setAddressType('shipping');
            $shippingAddress->setCreatedAt(date('Y-m-d H:i:s'));
            $shippingAddress->save();

            $sameAsBilling = $this->getRequest()->getPost('shipping_as_billing');
            if ($sameAsBilling) {
                $cartBillingAddress = $cart->getBillingAddress()->getData();
                unset($cartBillingAddress['address_id']);
                $shippingAddress->addData($cartBillingAddress);
                $shippingAddress->setAddressType('shipping');
                $shippingAddress->save();
            }

            $saveInAddress = $this->getRequest()->getPost('save_in_address_book');
            if ($saveInAddress) {
                $shippingAddress = $cart->getCustomer()->getShippingAddress();
                $cartShippingAddress = $cart->getShippingAddress()->getData();
                unset($cartShippingAddress['address_id']);
                unset($cartShippingAddress['cart_id']);
                $shippingAddress->addData($cartShippingAddress);
                $shippingAddress->setParentId($cart->getCustomerId());
                $shippingAddress->setIsDefaultShipping('1');
                $shippingAddress->setSaveInAddressBook('1');
                $shippingAddress->save();
            }

            $this->_redirect('*/*/');
        } catch (Exception $e) {
            $this->_getSession()->addError(Mage::helper('order')->__($e->getMessage()));
        }
    }

    public function saveProductAction()
    {
        $product = $this->getRequest()->getParams()['product'];
        $cart = $this->_getCart();
        $cart->addItemToCart($product);
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        $id = $this->getRequest()->getPost('delete');
        $id = key($id);
        $item = Mage::getModel('order/cart_item');
        $item->load($id);
        $item->delete();
        $this->_redirect('*/*/');
    }

    public function saveQtyAction()
    {
        $qtys = $this->getRequest()->getPost('qty');
        foreach ($qtys as $id => $qty) {
            $item = Mage::getModel('order/cart_item');
            $item->load($id);
            $item->setQty($qty);
            $item->save();
        }
        $this->_redirect('*/*/');
    }

    public function paymentMethodAction()
    {
        $cart = $this->_getCart();
        $paymentMethod = $this->getRequest()->getPost('method');
        $cart->setPaymentMethod($paymentMethod['payment']);
        $cart->save();
        $this->_redirect('*/*/');
    }

    public function shippingMethodAction()
    {
        $cart = $this->_getCart();
        $shippingMethod = $this->getRequest()->getPost('method');
        $shippingMethod = explode(',', $shippingMethod['shipping']);
        $shippingAmount = $shippingMethod[1];
        $shippingName = $shippingMethod[0];
        $cart->setShippingMethod($shippingName);
        $cart->setShippingAmount($shippingAmount);
        $cart->save();
        $this->_redirect('*/*/');
    }

    public function submitOrderAction()
    {
        try {
            $cart = $this->_getCart();

            $items = $cart->getItems();
            if (!array_filter($items)) {
                throw new Exception("Add Product.");
            }

            $billingAddress = $cart->getBillingAddress();
            if (!$billingAddress->getId()) {
                throw new Exception("Add Billing Address.");
            }

            $shippingAddress = $cart->getShippingAddress();
            if (!$shippingAddress->getId()) {
                throw new Exception("Add Shipping Address.");
            }

            $paymentMethod = $cart->getPaymentMethod();
            if (!$paymentMethod) {
                throw new Exception("Add Payment Method.");
            }

            $shippingMethod = $cart->getShippingMethod();
            if (!$shippingMethod) {
                throw new Exception("Add Shipping Method.");
            }

            $order = Mage::getModel('order/order');
            $order->setCustomerId($cart->getCustomerId());
            $order->setCustomerFirstname($cart->getCustomer()->getFirstname());
            $order->setCustomerLastname($cart->getCustomer()->getLastname());
            $order->setCustomerEmail($cart->getCustomer()->getEmail());
            $order->setGrandTotal($cart->getSubTotal() + $cart->getShippingAmount());
            $order->setCreatedAt(date('Y-m-d H:i:s'));
            $order->save();

            foreach ($items  as $item) {
                $orderItem = Mage::getModel('order/order_item');
                unset($item['item_id']);
                $orderItem->setData($item);
                $orderItem->setOrderId($order->getId());
                $orderItem->save();
            }

            $orderAddresss = Mage::getModel('order/order_address');
            $orderAddresss->setData($billingAddress->getData());
            $orderAddresss->save();

            $orderAddresss = Mage::getModel('order/order_address');
            $orderAddresss->setData($shippingAddress->getData());
            $orderAddresss->save();

            $cart->delete();
            $this->_redirect('*/adminhtml_order/index');
        } catch (Exception $e) {
            $this->_redirect('*/*/');
            $this->_getSession()->addError(Mage::helper('order')->__($e->getMessage()));
            $this->_redirect('*/*/');
        }
    }
}
