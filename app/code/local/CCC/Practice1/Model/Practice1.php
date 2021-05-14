<?php

class Ccc_Practice1_Model_Practice1 extends Mage_Core_Model_Abstract
{
    const STATUS_DISABLED   = 0;
    const STATUS_ENABLED    = 1;

    public function _construct()
    {
        $this->_init('practice1/practice1');
    }

    public function getStatusOptions()
    {
        return [
            self::STATUS_ENABLED => Mage::helper('practice1')->__('Enabled'),
            self::STATUS_DISABLED => Mage::helper('practice1')->__('Disabled')
        ];
    }
}
