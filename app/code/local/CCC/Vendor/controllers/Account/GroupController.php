<?php

class Ccc_Vendor_Account_GroupController extends Mage_Core_Controller_Front_Action
{
    public function indexAction()
    {
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('vendor/account/login');
        }
        $this->loadLayout();
        $this->_initLayoutMessages('vendor/session');
        $this->getLayout()->getBlock('head')->setTitle($this->__('Manage Product Attribute Group'));
        $this->renderLayout();
    }


    public function newAction()
    {
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('vendor/account/login');
        }
        $this->_forward('edit');
    }


    public function editAction()
    {
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('vendor/account/login');
        }
        $this->loadLayout();
        try {
            $groupId = (int) $this->getRequest()->getParam('id');
            $groupData = Mage::getModel('vendor/product_attribute_group');
            if ($groupId && !$groupData->load($groupId)) {
                throw new Exception("Invalid Id");
            }
            $groupData = Mage::getModel('vendor/product_attribute_group')->load($groupId);
            Mage::register('current_group', $groupData);
        } catch (Exception $e) {
            $this->_getSession()->setError($e->getMessage());
            $this->_redirect('*/*/');
        }
        $this->renderLayout();
    }


    public function saveAction()
    {
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('vendor/account/login');
        }
        $vendorId = $this->_getSession()->getId();
        $vendorProduct = Mage::getModel('vendor/product');
        $attributeDefaultId = $vendorProduct->getResource()->getEntityType()->getDefaultAttributeSetId();

        $model = Mage::getModel('eav/entity_attribute_group');

        $groupName = $vendorId . '_' . $this->getRequest()->getPost('gname');

        $model->setAttributeGroupName($groupName)
            ->setAttributeSetId($attributeDefaultId);


        if ($model->itemExists() && !$this->getRequest()->getParam('id')) {
            $this->_getSession()->addError(Mage::helper('vendor')->__('A group with the same name already exists.'));
            $this->_redirect('*/*/edit');
        } else {
            try {
                $attributeGroup = Mage::getModel('vendor/product_attribute_group');
                if ($id = $this->getRequest()->getParam('id')) {
                    $attributeGroup->setGroupId($id);
                    $data = $attributeGroup->load($id);
                    $model->setAttributeGroupId($data->getAttributeGroupId());
                }

                $model->save();

                $attributeGroup->setAttributeGroupName($this->getRequest()->getPost('gname'));
                $attributeGroup->setEntityId($vendorId);
                $attributeGroup->setAttributeGroupId($model->getId());

                $attributeGroup->save();

                $this->_getSession()->addSuccess(Mage::helper('vendor')->__('Group is created successfully..!'));
            } catch (Exception $e) {
                $this->_getSession()->addError(Mage::helper('vendor')->__('An error occurred while saving this group.'));
            }
        }
        $this->_redirect('*/*/');
    }


    public function _getSession()
    {
        return Mage::getSingleton('vendor/session');
    }


    public function deleteAction()
    {
        if (!$this->_getSession()->isLoggedIn()) {
            $this->_redirect('vendor/account/login');
            return;
        }
        if ($id = $this->getRequest()->getParam('id')) {
            $model = Mage::getModel('eav/entity_attribute_group');

            $model->load($id);
            try {
                $model->delete();
                $this->_getSession()->addSuccess(
                    Mage::helper('vendor')->__('Group deleted..!')
                );
                $this->_redirect('*/*/');
            } catch (Exception $e) {
                $this->_getSession()->addError($e->getMessage());
                $this->_redirect('*/*/');
            }
        }
    }
}
