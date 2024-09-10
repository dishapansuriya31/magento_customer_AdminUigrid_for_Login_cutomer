<?php
namespace Kitchen\CustomerData\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Login extends AbstractDb
{
    protected function _construct()
    {
        $this->_init('customer_login', 'entity_id');
    }
}
