<?php

$installer = $this;
$installer->startSetup();

$installer->getConnection()
    ->addColumn(
        $installer->getTable('practice1/practice1'),
        'status',
        [
            'type' => Varien_Db_Ddl_Table::TYPE_BOOLEAN,
            'nullabel' => false,
            'comment' => 'Status'
        ]
    );

$installer->getConnection()
    ->addColumn(
        $installer->getTable('practice1/practice1'),
        'created_date',
        [
            'type' => Varien_Db_Ddl_Table::TYPE_DATETIME,
            'nullable' => false,
            'comment' => 'Created Date'
        ]
    );

$installer->getConnection()
    ->addColumn(
        $installer->getTable('practice1/practice1'),
        'updated_date',
        [
            'type' => Varien_Db_Ddl_Table::TYPE_DATETIME,
            'nullable' => false,
            'comment' => 'Updated Date'
        ]
    );

$installer->endSetup();
