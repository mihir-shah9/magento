<?php

class Ccc_Order_Model_Cart extends Mage_Core_Model_Abstract
{
    protected $customer = null;
    protected $billingAddress = null;
    protected $shippingAddress = null;

    protected function _construct()
    {
        $this->_init('order/cart');
    }

    public function setCustomer(Mage_Customer_Model_Customer $customer)
    {
        $this->customer = $customer;
        return $this;
    }

    public function getCustomer()
    {
        if (!$this->customer) {
            $customer = Mage::getModel('customer/customer')->load($this->customer_id);
            $this->setCustomer($customer);
            return $this->customer;
        }
        return $this->customer;
    }

    public function setBillingAddress(Ccc_Order_Model_Cart_Address $billingAddress)
    {
        $this->billingAddress = $billingAddress;
        return $this;
    }

    public function getBillingAddress()
    {
        if ($this->billingAddress) {
            return $this->billingAddress;
        }

        if (!$this->getId()) {
            return false;
        }

        $address = Mage::getModel('order/cart_address');
        $addressCollection = $address->getCollection()
            ->addFieldToFilter('cart_id', ['eq' => $this->getId()])
            ->addFieldToFilter('address_type', ['eq' => Ccc_Order_Model_Cart_Address::ADDRESS_TYPE_BILLING]);
        $billingAddress = $addressCollection->getFirstItem()->getData();
        $address->setData($billingAddress);
        return $address;
    }


    public function setShippingAddress(Ccc_Order_Model_Cart_Address $shippingAddress)
    {
        $this->shippingAddress = $shippingAddress;
        return $this;
    }

    public function getShippingAddress()
    {

        if ($this->shippingAddress) {
            return $this->shippingAddress;
        }

        if (!$this->getId()) {
            return false;
        }

        $address = Mage::getModel('order/cart_address');
        $addressCollection = $address->getCollection()
            ->addFieldToFilter('cart_id', ['eq' => $this->getId()])
            ->addFieldToFilter('address_type', ['eq' => Ccc_Order_Model_Cart_Address::ADDRESS_TYPE_SHIPPING]);
        $address = $addressCollection->getFirstItem();
        return $address;
    }

    public function addItemToCart($ids)
    {
        $product = Mage::getModel('catalog/product');
        foreach ($ids as $id) {
            $product->load($id);
            $items = Mage::getModel('order/cart_item');

            $items->setCartId($this->getId());
            $items->setCreatedAt(date('Y-m-d H:i:s'));
            $items->setProductId($product->getId());
            $items->setSku($product->getSku());
            $items->setQty('1');
            $items->setName($product->getName());
            $items->setPrice($product->getPrice());
            $items->save();
        }
    }

    public function getItems()
    {
        $items = Mage::getModel('order/cart_item');
        $collection = $items->getCollection();

        $collection->getSelect()->where('cart_id = ?', $this->getId());
        $items = $collection->getResource()->getReadConnection()->fetchAll($collection->getSelect());

        return $items;
    }

    public function getSubTotal()
    {
        $subTotal = 0;
        $items = $this->getItems();
        foreach ($items as $item) {
            $subTotal = $subTotal + $item['price'] * $item['qty'];
        }
        return $subTotal;
    }
}
