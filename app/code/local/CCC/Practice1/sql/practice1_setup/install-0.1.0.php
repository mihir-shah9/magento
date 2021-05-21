<?php

$installer = $this;
$installer->startSetup();

$table = $installer->getConnection()
    ->newTable($installer->getTable('practice1/practice1'))
    ->addColumn(
        'practice1_id',
        Varien_Db_Ddl_Table::TYPE_INTEGER,
        null,
        [
            'identity' => true,
            'unsigned' => true,
            'primary' => true,
            'nullable' => false
        ],
        'practice1_id'
    )
    ->addColumn(
        'first_name',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        null,
        [
            'nullable' => false
        ],
        'first_name'
    )
    ->addColumn(
        'last_name',
        Varien_Db_Ddl_Table::TYPE_VARCHAR,
        null,
        [
            'nullable' => false
        ],
        'last_name'
    )
    ->addColumn(
        'mobile',
        Varien_Db_Ddl_Table::TYPE_NUMERIC,
        null,
        [
            'nullable' => false
        ],
        'mobile'
    );

$installer->getConnection()->createTable($table);
$installer->endSetup();
