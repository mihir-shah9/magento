<?php

$installer = $this;
$installer->startSetup();

/**
 * Create table 'order/cart'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/cart'))
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity' => true,
        'unsigned' => true,
        'nullable' => false,
        'primary' => true,
    ), 'Cart Id')

    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned' => true,
        'nullable' => false,
        'default' => '0',
    ), 'Customer Id')

    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => false,
    ), 'Created At')

    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable' => false,
    ), 'Updated At')

    ->addColumn('grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default' => '0.0000',
    ), 'Grand Total')

    ->addColumn('base_grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default' => '0.0000',
    ), 'Base Grand Total')

    // ->addForeignKey(
    //     $installer->getFkName('order/cart', 'store_id', 'core/store', 'store_id'),
    //     'store_id',
    //     $installer->getTable('core/store'),
    //     'store_id',
    //     Varien_Db_Ddl_Table::ACTION_CASCADE,
    //     Varien_Db_Ddl_Table::ACTION_CASCADE
    // )
    ->setComment('Order Cart');
$installer->getConnection()->createTable($table);


/**
 * Create table 'order/cart_address'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/cart_address'))
    ->addColumn('address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Address Id')
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Cart Id')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Updated At')
    ->addColumn('customer_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Customer Id')
    ->addColumn('save_in_address_book', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'default'   => '0',
    ), 'Save In Address Book')
    ->addColumn('customer_address_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Customer Address Id')
    ->addColumn('address_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Address Type')
    ->addColumn('email', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Email')
    ->addColumn('prefix', Varien_Db_Ddl_Table::TYPE_TEXT, 40, array(), 'Prefix')
    ->addColumn('firstname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Firstname')
    ->addColumn('middlename', Varien_Db_Ddl_Table::TYPE_TEXT, 40, array(), 'Middlename')
    ->addColumn('lastname', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Lastname')
    ->addColumn('suffix', Varien_Db_Ddl_Table::TYPE_TEXT, 40, array(), 'Suffix')
    ->addColumn('company', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Company')
    ->addColumn('street', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Street')
    ->addColumn('city', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'City')
    ->addColumn('region', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Region')
    ->addColumn('region_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Region Id')
    ->addColumn('postcode', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Postcode')
    ->addColumn('country_id', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Country Id')
    ->addColumn('telephone', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Telephone')
    ->addColumn('fax', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Fax')
    ->addColumn('same_as_billing', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Same As Billing')

    ->addColumn('shipping_method', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Shipping Method')
    ->addColumn('shipping_description', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Shipping Description')
    ->addColumn('weight', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Weight')
    ->addColumn('subtotal', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Subtotal')
    ->addColumn('base_subtotal', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Subtotal')
    ->addColumn('subtotal_with_discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Subtotal With Discount')
    ->addColumn('base_subtotal_with_discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Subtotal With Discount')
    ->addColumn('tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Tax Amount')
    ->addColumn('base_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Tax Amount')
    ->addColumn('shipping_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Shipping Amount')
    ->addColumn('base_shipping_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Shipping Amount')
    ->addColumn('shipping_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Shipping Tax Amount')
    ->addColumn('base_shipping_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Shipping Tax Amount')
    ->addColumn('discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Discount Amount')
    ->addColumn('base_discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Discount Amount')
    ->addColumn('grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Grand Total')
    ->addColumn('base_grand_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Grand Total')
    ->addColumn('customer_notes', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Customer Notes')
    ->addColumn('applied_taxes', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Applied Taxes')
    ->addColumn('discount_description', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Discount Description')
    ->addColumn('shipping_discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Shipping Discount Amount')
    ->addColumn('base_shipping_discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Shipping Discount Amount')
    ->addColumn('subtotal_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Subtotal Incl Tax')
    ->addColumn('base_subtotal_total_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Subtotal Total Incl Tax')
    ->addColumn('hidden_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Hidden Tax Amount')
    ->addColumn('base_hidden_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Hidden Tax Amount')
    ->addColumn('shipping_hidden_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Shipping Hidden Tax Amount')
    ->addColumn('base_shipping_hidden_tax_amnt', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Shipping Hidden Tax Amount')
    ->addColumn('shipping_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Shipping Incl Tax')
    ->addColumn('base_shipping_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Shipping Incl Tax')

    ->addForeignKey(
        $installer->getFkName('order/cart_address', 'cart_id', 'order/cart', 'cart_id'),
        'cart_id',
        $installer->getTable('order/cart'),
        'cart_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->setComment('Order Cart Address');
$installer->getConnection()->createTable($table);



/**
 * Create table 'order/cart_item'
 */
$table = $installer->getConnection()
    ->newTable($installer->getTable('order/cart_item'))
    ->addColumn('item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'identity'  => true,
        'unsigned'  => true,
        'nullable'  => false,
        'primary'   => true,
    ), 'Item Id')
    ->addColumn('cart_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Cart Id')
    ->addColumn('created_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Created At')
    ->addColumn('updated_at', Varien_Db_Ddl_Table::TYPE_TIMESTAMP, null, array(
        'nullable'  => false,
    ), 'Updated At')
    ->addColumn('product_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Product Id')
    ->addColumn('store_id', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
    ), 'Store Id')
    ->addColumn('parent_item_id', Varien_Db_Ddl_Table::TYPE_INTEGER, null, array(
        'unsigned'  => true,
    ), 'Parent Item Id')
    ->addColumn('is_virtual', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
    ), 'Is Virtual')
    ->addColumn('sku', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Sku')
    ->addColumn('name', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Name')
    ->addColumn('description', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Description')
    ->addColumn('applied_rule_ids', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Applied Rule Ids')
    ->addColumn('additional_data', Varien_Db_Ddl_Table::TYPE_TEXT, '64k', array(), 'Additional Data')
    ->addColumn('free_shipping', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'nullable'  => false,
        'default'   => '0',
    ), 'Free Shipping')
    ->addColumn('is_qty_decimal', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
    ), 'Is Qty Decimal')
    ->addColumn('no_discount', Varien_Db_Ddl_Table::TYPE_SMALLINT, null, array(
        'unsigned'  => true,
        'default'   => '0',
    ), 'No Discount')
    ->addColumn('weight', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Weight')
    ->addColumn('qty', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Qty')
    ->addColumn('price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Price')
    ->addColumn('base_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Price')
    ->addColumn('custom_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Custom Price')
    ->addColumn('discount_percent', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Discount Percent')
    ->addColumn('discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Discount Amount')
    ->addColumn('base_discount_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Base Discount Amount')
    ->addColumn('tax_percent', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Tax Percent')
    ->addColumn('tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Tax Amount')
    ->addColumn('base_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Base Tax Amount')
    ->addColumn('row_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Row Total')
    ->addColumn('base_row_total', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'nullable'  => false,
        'default'   => '0.0000',
    ), 'Base Row Total')
    ->addColumn('row_total_with_discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Row Total With Discount')
    ->addColumn('row_weight', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(
        'default'   => '0.0000',
    ), 'Row Weight')
    ->addColumn('product_type', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Product Type')
    ->addColumn('base_tax_before_discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Tax Before Discount')
    ->addColumn('tax_before_discount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Tax Before Discount')
    ->addColumn('original_custom_price', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Original Custom Price')
    ->addColumn('redirect_url', Varien_Db_Ddl_Table::TYPE_TEXT, 255, array(), 'Redirect Url')
    ->addColumn('base_cost', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Cost')
    ->addColumn('price_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Price Incl Tax')
    ->addColumn('base_price_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Price Incl Tax')
    ->addColumn('row_total_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Row Total Incl Tax')
    ->addColumn('base_row_total_incl_tax', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Row Total Incl Tax')
    ->addColumn('hidden_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Hidden Tax Amount')
    ->addColumn('base_hidden_tax_amount', Varien_Db_Ddl_Table::TYPE_DECIMAL, '12,4', array(), 'Base Hidden Tax Amount')
    ->addIndex(
        $installer->getIdxName('sales/quote_item', array('parent_item_id')),
        array('parent_item_id')
    )
    ->addIndex(
        $installer->getIdxName('sales/quote_item', array('product_id')),
        array('product_id')
    )
    ->addIndex(
        $installer->getIdxName('sales/quote_item', array('store_id')),
        array('store_id')
    )
    // ->addForeignKey(
    //     $installer->getFkName('sales/quote_item', 'parent_item_id', 'sales/quote_item', 'item_id'),
    //     'parent_item_id',
    //     $installer->getTable('sales/quote_item'),
    //     'item_id',
    //     Varien_Db_Ddl_Table::ACTION_CASCADE,
    //     Varien_Db_Ddl_Table::ACTION_CASCADE
    // )
    ->addForeignKey(
        $installer->getFkName('order/cart_item', 'product_id', 'catalog/product', 'entity_id'),
        'product_id',
        $installer->getTable('catalog/product'),
        'entity_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    ->addForeignKey(
        $installer->getFkName('order/cart_item', 'cart_id', 'order/cart', 'cart_id'),
        'cart_id',
        $installer->getTable('order/cart'),
        'cart_id',
        Varien_Db_Ddl_Table::ACTION_CASCADE,
        Varien_Db_Ddl_Table::ACTION_CASCADE
    )
    // ->addForeignKey(
    //     $installer->getFkName('sales/quote_item', 'store_id', 'core/store', 'store_id'),
    //     'store_id',
    //     $installer->getTable('core/store'),
    //     'store_id',
    //     Varien_Db_Ddl_Table::ACTION_SET_NULL,
    //     Varien_Db_Ddl_Table::ACTION_CASCADE
    // )
    ->setComment('Order Cart Item');
$installer->getConnection()->createTable($table);

$installer->endSetup();
