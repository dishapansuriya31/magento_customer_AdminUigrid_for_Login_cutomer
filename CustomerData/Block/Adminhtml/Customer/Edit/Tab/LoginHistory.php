<?php
namespace Kitchen\CustomerData\Block\Adminhtml\Customer\Edit\Tab;

use Magento\Backend\Block\Template;
use Magento\Backend\Block\Widget\Tab\TabInterface;
use Kitchen\CustomerData\Model\ResourceModel\Login\CollectionFactory as LoginCollectionFactory;

class LoginHistory extends Template implements TabInterface
{
    protected $loginCollectionFactory;

    public function __construct(
        Template\Context $context,
        LoginCollectionFactory $loginCollectionFactory,
        array $data = []
    ) {
        $this->loginCollectionFactory = $loginCollectionFactory;
        parent::__construct($context, $data);
    }

    public function getCustomerId()
    {
        return $this->_coreRegistry->registry(\Magento\Customer\Controller\RegistryConstants::CURRENT_CUSTOMER_ID);
    }

    public function getTabLabel()
    {
        return __('Login History');
    }

    public function getTabTitle()
    {
        return __('Login History');
    }

    public function canShowTab()
    {
        return true;
    }

    public function isHidden()
    {
        return false;
    }

    protected function _toHtml()
    {
        $customerId = $this->getCustomerId();
        $loginHistory = $this->getLoginHistory($customerId);

        if ($loginHistory->getSize()) {
            $html = '<h2>Customer Login History</h2><ul>';
            foreach ($loginHistory as $login) {
                $html .= '<li>' . __('Login At: ') . $login->getLoginDate() . ' - ' . __('Email: ') . $login->getCustomerEmail() . '</li>';
            }
            $html .= '</ul>';
        } else {
            $html = '<p>' . __('No Login History Found') . '</p>';
        }

        return $html;
    }

    protected function getLoginHistory($customerId)
    {
        $collection = $this->loginCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId)
            ->setOrder('login_date', 'DESC');

        return $collection;
    }
}
