<?php

$this->startSetup();

$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_datetime')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_decimal')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_int')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_text')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_varchar')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_char')};");
$installer->run("
-- DROP TABLE IF EXISTS {$this->getTable('vendor/vendor_eav_attribute')};");

$this->addEntityType(Ccc_Vendor_Model_Resource_Vendor::ENTITY, [
    'entity_model'                => 'vendor/vendor',
    'attribute_model'             => 'vendor/attribute',
    'table'                       => 'vendor/vendor',
    'increment_per_store'         => '0',
    'additional_attribute_table'  => 'vendor/eav_attribute',
    'entity_attribute_collection' => 'vendor/vendor_attribute_collection',
]);

$this->createEntityTables('vendor');

$default_attribute_set_id = Mage::getModel('eav/entity_setup', 'core_setup')
    ->getAttributeSetId('vendor', 'Default');

$this->run("UPDATE `eav_entity_type` SET `default_attribute_set_id` = {$default_attribute_set_id} WHERE `entity_type_code` = 'vendor'");

$this->endSetup();
