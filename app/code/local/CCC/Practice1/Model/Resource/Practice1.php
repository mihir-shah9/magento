<?php

class Ccc_Practice1_Model_Resource_Practice1 extends
Mage_Core_Model_Resource_Db_Abstract
{
    public function _construct()
    {
        $this->_init('practice1/practice1', 'practice1_id');
    }
}
