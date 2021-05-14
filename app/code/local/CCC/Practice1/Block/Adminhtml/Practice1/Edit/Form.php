<?php

class Ccc_Practice1_Block_Adminhtml_Practice1_Edit_Form extends
Mage_Adminhtml_Block_Widget_Form
{
    protected function _prepareForm()
    {
        $form = new Varien_Data_Form([
            'id' => 'edit_form',
            'action' => $this->getUrl('*/*/save', ['id' => $this->getRequest()->getParam('id')]),
            'method' => 'post'
        ]);

        $form->setUseContainer(true);
        $this->setForm($form);

        $fieldset = $form->addFieldset('practice1_form', ['legend' => Mage::helper('practice1')->__('Practice1 Information')]);

        $fieldset->addField('first_name', 'text', [
            'label' => 'First Name',
            'name' => 'first_name'
        ]);

        $fieldset->addField('last_name', 'text', [
            'label' => 'Last Name',
            'name' => 'last_name'
        ]);

        $fieldset->addField('mobile', 'text', [
            'label' => 'Mobile Number',
            'name' => 'mobile'
        ]);

        $fieldset->addField('status', 'select', [
            'label' => 'Status',
            'name' => 'status',
            'values' => Mage::getSingleton('practice1/practice1')->getStatusOptions()
        ]);

        $form->addFieldNameSuffix('practice1');

        if (Mage::registry('practice1_id')->getId()) {
            $form->setValues(Mage::registry('practice1_id')->getData());
        }
    }
}
