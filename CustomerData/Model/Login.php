<?php
namespace Kitchen\CustomerData\Model;

use Magento\Framework\Model\AbstractModel;

class Login extends AbstractModel
{
    protected function _construct()
    {
        $this->_init(\Kitchen\CustomerData\Model\ResourceModel\Login::class);
    }
}
