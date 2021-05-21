<?php

class Ccc_Practice1_Block_Adminhtml_Practice1_Grid extends
Mage_Adminhtml_Block_Widget_Grid
{
    public function __construct()
    {
        parent::__construct();
        $this->setId('practice1Grid');
        $this->setDefaultDir('ASC');
        $this->setDefaultSort('practice1_id');
    }

    protected function _prepareCollection()
    {
        $collection = Mage::getModel('practice1/practice1')->getCollection();
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn('practice1_id', [
            'header' => 'Id',
            'align' => 'right',
            'type' => 'number',
            'index' => 'practice1_id'
        ]);

        $this->addColumn('first_name', [
            'header' => 'First Name',
            'index' => 'first_name'
        ]);

        $this->addColumn('last_name', [
            'header' => 'Last Name',
            'index' => 'last_name'
        ]);

        $this->addColumn('mobile', [
            'header' => 'Mobile Number',
            'index' => 'mobile'
        ]);

        $this->addColumn('status', [
            'header' => 'Status',
            'index' => 'status',
            'width' => '70px',
            'type' => 'options',
            'options' => Mage::getSingleton('practice1/practice1')->getStatusOptions()
        ]);

        $this->addColumn('created_date', [
            'header' => 'Creation Date',
            'align' => 'left',
            'width' => '120px',
            'type' => 'date',
            'default' => '–',
            'format' => 'yyyy/MM/dd H:m:s',
            'index' => 'created_date'
        ]);

        $this->addColumn('updated_date', [
            'header' => 'Updation Date',
            'align' => 'left',
            'width' => '120px',
            'type' => 'date',
            'default' => '–',
            'format' => 'yyyy/MM/dd H:m:s',
            'index' => 'updated_date'
        ]);

        return parent::_prepareColumns();
    }

    public function getRowUrl($row)
    {
        return $this->getUrl('*/*/edit', ['id' => $row->getId()]);
    }
}
