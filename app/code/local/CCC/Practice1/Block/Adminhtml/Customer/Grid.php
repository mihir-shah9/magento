<?php

class Ccc_Practice1_Block_Adminhtml_Customer_Grid extends
Mage_Adminhtml_Block_Customer_Grid
{
    protected function _prepareColumns()
    {
        parent::_prepareColumns();
        $this->removeColumn('Telephone');
        return $this;
    }
}
