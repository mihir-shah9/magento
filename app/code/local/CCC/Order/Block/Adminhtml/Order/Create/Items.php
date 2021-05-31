<?php

class Ccc_Order_Block_Adminhtml_Order_Create_Items extends Mage_Adminhtml_Block_Sales_Order_Create_Abstract
{
    /**
     * Contains button descriptions to be shown at the top of accordion
     * @var array
     */
    protected $_buttons = array();

    /**
     * Define block ID
     */
    public function __construct()
    {
        parent::__construct();
        $this->setId('order_create_items');
    }

    /**
     * Accordion header text
     *
     * @return string
     */
    public function getHeaderText()
    {
        return Mage::helper('order')->__('Items Ordered');
    }

    /**
     * Returns all visible items
     *
     * @return array
     */
    public function getItems()
    {
        return $this->getQuote()->getAllVisibleItems();
    }

    /**
     * Add button to the items header
     *
     * @param $args array
     */
    public function addButton($args)
    {
        $this->_buttons[] = $args;
    }

    /**
     * Render buttons and return HTML code
     *
     * @return string
     */
    public function getButtonsHtml()
    {
        $html = '';
        // Make buttons to be rendered in opposite order of addition. This makes "Add products" the last one.
        $this->_buttons = array_reverse($this->_buttons);
        foreach ($this->_buttons as $buttonData) {
            $html .= $this->getLayout()->createBlock('adminhtml/widget_button')->setData($buttonData)->toHtml();
        }

        return $html;
    }

    /**
     * Return HTML code of the block
     *
     * @return string
     */
    protected function _toHtml()
    {
        if ($this->getStoreId()) {
            return parent::_toHtml();
        }
        return '';
    }
}
