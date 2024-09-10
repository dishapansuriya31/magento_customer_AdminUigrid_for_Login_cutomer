<?php

namespace Kitchen\CustomerData\Model\ResourceModel\Login;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    protected $_idFieldName = 'entity_id';
    protected function _construct()
    {
        $this->_init(
            \Kitchen\CustomerData\Model\Login::class,
            \Kitchen\CustomerData\Model\ResourceModel\Login::class
        );
    }
}
