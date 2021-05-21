<?php

class Ccc_Practice1_Adminhtml_Practice1Controller extends
Mage_Adminhtml_Controller_Action
{
    public function indexAction()
    {
        $this->loadLayout();
        $this->_setActiveMenu('practice1/items');
        $this->renderLayout();
    }

    public function newAction()
    {
        $this->_forward('edit');
    }

    public function editAction()
    {
        $practice1Id = $this->getRequest()->getParam('id');
        $practice1Model = Mage::getModel('practice1/practice1')->load($practice1Id);

        if ($practice1Id && !$practice1Model->getId()) {
            $this->_redirect('*/*/');
            return;
        }
        Mage::register('practice1_id', $practice1Model);
        $this->loadLayout();
        $this->_setActiveMenu('practice1/items');
        $this->renderLayout();
    }

    public function saveAction()
    {
        if (!$this->getRequest()->isPost()) {
            $this->_redirect('*/*/');
            return;
        }
        try {
            $practice1Id = $this->getRequest()->getParam('id');
            $practice1Data = $this->getRequest()->getPost('practice1');
            $practice1Model = Mage::getModel('practice1/practice1');

            if ($practice1Id) {
                $practice1Model->load($practice1Id);
                $practice1Model->setUpdatedDate(Mage::getModel('core/date')->date('Y-m-d H:i:s'));
            } else {
                $practice1Model->createdDate = date("Y-m-d H:i:s");
                $practice1Model->setCreatedDate(Mage::getModel('core/date')->date('Y-m-d H:i:s'));
            }

            $practice1Model->addData($practice1Data);
            $practice1Model->save();
            $this->_getSession()->addSuccess(Mage::helper('practice1')->__('Practice1 was successfully saved.'));
        } catch (Exception $e) {
            $this->_getSession()->addError(Mage::helper('practice1')->__($e->getMessage()));
        }
        $this->_redirect('*/*/');
    }

    public function deleteAction()
    {
        try {
            $practice1Id = $this->getRequest()->getParam('id');
            if (!$practice1Id) {
                throw new Exception("Id required.");
            }
            $practice1Model = Mage::getModel('practice1/practice1')->load($practice1Id);
            if (!$practice1Model->getId()) {
                throw new Exception("Data not found.");
            }
            $practice1Model->delete();
            $this->_getSession()->addSuccess(Mage::helper('practice1')->__('Practice1 was successfully deleted.'));
        } catch (Exception $e) {
            $this->_getSession()->addError(Mage::helper('practice1')->__($e->getMessage()));
        }
        $this->_redirect('*/*/');
    }
}
