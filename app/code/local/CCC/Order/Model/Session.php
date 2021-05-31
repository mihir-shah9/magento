<?php
class Ccc_Order_Model_Session extends Mage_Core_Model_Session_Abstract
{
    public function __construct()
    {
        $this->init('adminhtml');
    }
}
// <?php
// class Ccc_Order_Model_Session_Quote extends Mage_Core_Model_Session_Abstract
// {
//     public function __construct()
//     {
//         $this->init('order_quote');
//     }
   
// }