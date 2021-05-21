<?php

class Ccc_Vendor_Helper_Data extends Mage_Core_Helper_Abstract
{
    const REFERER_QUERY_PARAM_NAME = 'referer';
    const XML_PATH_VENDOR_STARTUP_REDIRECT_TO_DASHBOARD = 'customer/startup/redirect_dashboard';
    const ROUTE_ACCOUNT_LOGIN = 'vendor/account/login';


    public function getAccountUrl()
    {
        return $this->_getUrl('vendor/account');
    }

    public function getLoginUrl()
    {
        // return $this->_getUrl('vendor/account/login');
        return $this->_getUrl(self::ROUTE_ACCOUNT_LOGIN, $this->getLoginUrlParams());
    }

    /**
     * Retrieve parameters of customer login url
     *
     * @return array
     */
    public function getLoginUrlParams()
    {
        $params = array();

        $referer = $this->_getRequest()->getParam(self::REFERER_QUERY_PARAM_NAME);

        if (
            !$referer && !Mage::getStoreConfigFlag(self::XML_PATH_VENDOR_STARTUP_REDIRECT_TO_DASHBOARD)
            && !Mage::getSingleton('vendor/session')->getNoReferer()
        ) {
            $referer = Mage::getUrl('*/*/*', array('_current' => true, '_use_rewrite' => true));
            $referer = Mage::helper('core')->urlEncode($referer);
        }

        if ($referer) {
            $params = array(self::REFERER_QUERY_PARAM_NAME => $referer);
        }
        return $params;
    }

    /**
     * Retrieve customer login POST URL
     *
     * @return string
     */
    public function getLoginPostUrl()
    {
        $params = array();
        if ($this->_getRequest()->getParam(self::REFERER_QUERY_PARAM_NAME)) {
            $params = array(
                self::REFERER_QUERY_PARAM_NAME => $this->_getRequest()->getParam(self::REFERER_QUERY_PARAM_NAME)
            );
        }
        return $this->_getUrl('vendor/account/loginPost', $params);
    }

    /**
     * Retrieve customer logout url
     *
     * @return string
     */
    public function getLogoutUrl()
    {
        return $this->_getUrl('vendor/account/logout');
    }

    /**
     * Retrieve customer dashboard url
     *
     * @return string
     */
    public function getDashboardUrl()
    {
        return $this->_getUrl('vendor/account');
    }

    public function getRegisterUrl()
    {
        return $this->_getUrl('vendor/account/create');
    }

    public function getForgotPasswordUrl()
    {
        return $this->_getUrl('vendor/account/forgotpassword');
    }

    // public function isLoggedIn()
    // {
    //     return Mage::getSingleton('vendor/session')->isLoggedIn();
    // }

    public function isRegistrationAllowed()
    {
        $result = new Varien_Object(array('is_allowed' => true));
        Mage::dispatchEvent('vendor_registration_is_allowed', array('result' => $result));
        return $result->getIsAllowed();
    }

    public function getRegisterPostUrl()
    {
        return $this->_getUrl('vendor/account/createpost');
    }

    public function getEmailConfirmationUrl($email = null)
    {
        return $this->_getUrl('vendor/account/confirmation', array('email' => $email));
    }
}

