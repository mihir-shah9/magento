<?php

$installer = $this;
$installer->startSetup();

/**
 * Create table 'order/order'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/order'))
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Order Id')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned' => true,
    ), 'Customer Id')
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Cart Id')

    ->addColumn('customer_email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Customer Email')
    ->addColumn('customer_firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Customer Firstname')
    ->addColumn('customer_lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Customer Lastname')
    ->addColumn('customer_middlename', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Customer Middlename')

    ->addColumn('state', Varien_Db_Ddl_Table::TYPE_TEXT, 32, array(), 'State')
    ->addColumn('status', Varien_Db_Ddl_Table::TYPE_TEXT, 32, array(), 'Status')

    ->addColumn('base_grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Grand Total')

    ->addColumn('base_subtotal', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Subtotal')

    ->addColumn('grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Grand Total')

    ->addColumn('subtotal', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Subtotal')

    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(), 'Updated At')

    // ->addForeignKey(
    //     $installer->getFkName('order/order', 'customer_id', 'customer/entity', 'entity_id'),
    //     'customer_id',
    //     $installer->getTable('customer/entity'),
    //     'entity_id',
    //     Varien_Db_Ddl_Table::ACTION_SET_NULL,
    //     Varien_Db_Ddl_Table::ACTION_CASCADE
    // )
    // ->addForeignKey($installer->getFkName('sales/order', 'store_id', 'core/store', 'store_id'),
    // 'store_id', $installer->getTable('core/store'), 'store_id',
    // Varien_Db_Ddl_Table::ACTION_SET_NULL, Varien_Db_Ddl_Table::ACTION_CASCADE)
    ->setComment('Order');
$installer->getConnection()->createTable($table);


/**
 * Create table 'order/order_address'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/order_address'))
    ->addColumn('order_address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Order Address Id')

    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(), 'Customer Id')

    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Firstname')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Lastname')
    ->addColumn('middlename', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Middlename')
    ->addColumn('street', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Street')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'City')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Email')
    ->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Telephone')
    ->addColumn('country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 2, array(), 'Country Id')
    ->addColumn('address_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Address Type')

    // ->addForeignKey(
    //     $installer->getFkName('sales/order_address', 'parent_id', 'sales/order', 'entity_id'),
    //     'parent_id',
    //     $installer->getTable('sales/order'),
    //     'entity_id',
    //     Varien_Db_Ddl_Table::ACTION_CASCADE,
    //     Varien_Db_Ddl_Table::ACTION_CASCADE
    // )
    ->setComment('Order Address');
$installer->getConnection()->createTable($table);

/**
 * Create table 'order/order_item'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/order_item'))
    ->addColumn('item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Item Id')
    ->addColumn('order_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Order Id')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Product Id')

    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Updated At')


    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Sku')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Name')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Description')


    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Price')
    ->addColumn('base_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Price')
    ->addColumn('original_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Original Price')
    ->addColumn('base_original_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Original Price')
    ->addColumn('tax_percent', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Tax Percent')
    ->addColumn('tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Tax Amount')
    ->addColumn('base_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Base Tax Amount')

    ->addColumn('discount_percent', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Discount Percent')
    ->addColumn('discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Discount Amount')
    ->addColumn('base_discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Base Discount Amount')

    ->addForeignKey(
        $installer->getFkName('order/order_item', 'order_id', 'order/order', 'order_id'),
        'order_id',
        $installer->getTable('order/order'),
        'order_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    // ->addForeignKey(
    //     $installer->getFkName('sales/order_item', 'store_id', 'core/store', 'store_id'),
    //     'store_id',
    //     $installer->getTable('core/store'),
    //     'store_id',
    //     Varien_Db_Ddl_Table::ACTION_SET_NULL,
    //     Varien_Db_Ddl_Table::ACTION_CASCADE
    // )
    ->setComment('Order Item');
$installer->getConnection()->createTable($table);
$installer->endSetup();
