<?php

class Ccc_Order_Block_Adminhtml_Order_Grid extends
Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('orderGrid');
        $this->setDefaultSort('order_id');
        $this->setDefaultDir('ASC');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('order/order')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('order_id', [
            'header' => 'Id',
            'align' => 'right',
            'type' => 'number',
            'index' => 'order_id'
        ]);

        $this->addColumn('customer_firstname', [
            'header' => 'Firstname',
            'index' => 'customer_firstname'
        ]);

        $this->addColumn('customer_lastname', [
            'header' => 'Lastname',
            'index' => 'customer_lastname'
        ]);

        $this->addColumn('customer_email', [
            'header' => 'Email',
            'index' => 'customer_email'
        ]);

        $this->addColumn('grand_total', [
            'header' => 'Grand Total',
            'index' => 'grand_total'
        ]);

        // $this->addColumn('status', [
        //     'header' => 'Status',
        //     'index' => 'status',
        //     'width' => '70px',
        //     'type' => 'options',
        //     'options' => Mage::getSingleton('practice1/practice1')->getStatusOptions()
        // ]);

        $this->addColumn('created_at', [
            'header' => 'Creation Date',
            'align' => 'left',
            'width' => '120px',
            'type' => 'date',
            'default' => '–',
            'format' => 'yyyy/MM/dd H:m:s',
            'index' => 'created_at'
        ]);

        $this->addColumn('updated_at', [
            'header' => 'Updation Date',
            'align' => 'left',
            'width' => '120px',
            'type' => 'date',
            'default' => '–',
            'format' => 'yyyy/MM/dd H:m:s',
            'index' => 'updated_at'
        ]);

        return parent::_prepareColumns();
    }

    protected function _prepareMassaction()
    {
        $this->setMassactionIdField('entity_id');
        $this->getMassactionBlock()->setFormFieldName('product');

        $statuses = Mage::getSingleton('order/product_status')->getOptionArray();

        array_unshift($statuses, array('label' => '', 'value' => ''));
        $this->getMassactionBlock()->addItem('status', array(
            'label' => Mage::helper('order')->__('Change status'),
            'url'  => $this->getUrl('*/*/massStatus', array('_current' => true)),
            'additional' => array(
                'visibility' => array(
                    'name' => 'status',
                    'type' => 'select',
                    'class' => 'required-entry',
                    'label' => Mage::helper('order')->__('Status'),
                    'values' => $statuses
                )
            )
        ));
        return $this;
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }
}
