<?php
class Ccc_Vendor_Model_Resource_Product extends Mage_Catalog_Model_Resource_Abstract
{
    const ENTITY = 'vendor_product';

    public function __construct()
    {

        $this->setType(self::ENTITY)
            ->setConnection('core_read', 'core_write');

        parent::__construct();
    }

    public function getIdBySku($sku)
    {
        $adapter = $this->_getReadAdapter();

        $select = $adapter->select()
            ->from($this->getEntityTable(), 'entity_id')
            ->where('sku = :sku');

        $bind = array(':sku' => (string)$sku);

        return $adapter->fetchOne($select, $bind);
    }
}
