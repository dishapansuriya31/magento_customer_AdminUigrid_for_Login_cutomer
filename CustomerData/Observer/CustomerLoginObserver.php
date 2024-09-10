<?php
namespace Kitchen\CustomerData\Observer;

use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Event\Observer;
use Kitchen\CustomerData\Model\LoginFactory;
use Magento\Customer\Model\Session;

class CustomerLoginObserver implements ObserverInterface
{
    protected $loginFactory;
    protected $customerSession;

    public function __construct(
        LoginFactory $loginFactory,
        Session $customerSession
    ) {
        $this->loginFactory = $loginFactory;
        $this->customerSession = $customerSession;
    }

    public function execute(Observer $observer)
    {
        $customer = $observer->getEvent()->getCustomer();
        $login = $this->loginFactory->create();
        $login->setCustomerId($customer->getId());
        $login->setCustomerEmail($customer->getEmail());
        $login->setLoginDate(date('Y-m-d H:i:s'));
        $login->save();
    }
}
