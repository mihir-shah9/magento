<?php

class Ccc_Vendor_Model_Resource_Form_Attribute_Collection extends Mage_Eav_Model_Resource_Form_Attribute_Collection
{
    /**
     * Current module pathname
     *
     * @var string
     */
    protected $_moduleName = 'vendor';

    /**
     * Current EAV entity type code
     *
     * @var string
     */
    protected $_entityTypeCode = 'vendor';

    /**
     * Resource initialization
     */
    protected function _construct()
    {
        parent::_construct();
        $this->_init('eav/attribute', 'vendor/form_attribute');
    }

    /**
     * Get EAV website table
     *
     * Get table, where website-dependent attribute parameters are stored.
     * If realization doesn't demand this functionality, let this function just return null
     *
     * @return string|null
     */
    protected function _getEavWebsiteTable()
    {
        return $this->getTable('customer/eav_attribute_website');
    }
}
