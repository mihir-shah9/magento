<?php

$installer = $this;
$installer->startSetup();

$installer->run("
    ALTER TABLE {$this->getTable('order/cart')}
    ADD COLUMN `shipping_name` TEXT(255) NOT NULL;
    ");
$installer->run("
    ALTER TABLE {$this->getTable('order/cart')}
    ADD COLUMN `billing_name` TEXT(255) NOT NULL;
    ");
$installer->run("
    ALTER TABLE {$this->getTable('order/cart')}
    ADD COLUMN `shipping_method` TEXT(255) NOT NULL;
    ");
$installer->run("
    ALTER TABLE {$this->getTable('order/cart')}
    ADD COLUMN `payment_method` TEXT(255) NOT NULL;
    ");
$installer->run("
    ALTER TABLE {$this->getTable('order/cart')}
    ADD COLUMN `shipping_amount` TEXT(255) NOT NULL;
    ");

$installer->endSetup();
