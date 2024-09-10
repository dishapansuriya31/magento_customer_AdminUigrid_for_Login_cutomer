<?php
namespace Kitchen\CustomerData\Block\Adminhtml\Customer\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Magento\Framework\Registry;

class Tabs extends \Magento\Backend\Block\Template implements TabInterface
{
    protected $_coreRegistry;

    public function __construct(
        Context $context,
        Registry $registry,
        array $data = []
    ) {
        $this->_coreRegistry = $registry;
        parent::__construct($context, $data);
    }

    public function getTabLabel()
    {
        return __('Customer History');
    }

    public function getTabTitle()
    {
        return __('Customer History');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    public function getCustomerId()
    {
        return $this->_coreRegistry->registry('current_customer')->getId();
    }

    public function getTabUrl()
    {
        return $this->getUrl('customerdata/customer/history', ['_current' => true]);
    }

    public function isAjaxLoaded()
    {
        return false; 
    }
}
