<?php

class Ccc_Vendor_Model_Form extends Mage_Eav_Model_Form
{
    protected $_moduleName = 'vendor';

    protected $_entityTypeCode = 'vendor';

    // protected $_formCode;

    protected function _getFormAttributeCollection()
    {
        return parent::_getFormAttributeCollection()
            ->addFieldToFilter('attribute_code', array('neq' => 'created_at'));
    }

    /**
     * Return array of form attributes
     *
     * @return array
     */
    public function getAttributes()
    {
        if (is_null($this->_attributes)) {
            /* @var $collection Mage_Eav_Model_Resource_Form_Attribute_Collection */
            $collection = $this->_getFormAttributeCollection();

            $collection->setStore($this->getStore())
                ->setEntityType($this->getEntityType())
                ->addFormCodeFilter($this->getFormCode());

            $this->_attributes      = array();
            $this->_userAttributes  = array();
            foreach ($collection as $attribute) {
                /* @var $attribute Mage_Eav_Model_Entity_Attribute */
                $this->_attributes[$attribute->getAttributeCode()] = $attribute;
                if ($attribute->getIsUserDefined()) {
                    $this->_userAttributes[$attribute->getAttributeCode()] = $attribute;
                } else {
                    $this->_systemAttributes[$attribute->getAttributeCode()] = $attribute;
                }
            }
        }
        return $this->_attributes;
    }

    // public function getFormCode()
    // {
    //     if (empty($this->_formCode)) {
    //         Mage::throwException(Mage::helper('eav')->__('Form code is not defined'));
    //     }
    //     return $this->_formCode;
    // }
}
