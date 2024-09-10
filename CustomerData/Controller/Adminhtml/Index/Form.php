<?php
namespace Kitchen\CustomerData\Controller\Adminhtml\Index;

use Magento\Framework\Controller\ResultFactory;

class Form extends \Magento\Backend\App\Action
{
    /**
     * @var \Magento\Framework\View\Result\PageFactory
     */
    protected $resultPageFactory;

    /**
     * @param \Magento\Backend\App\Action\Context $context
     * @param \Magento\Framework\View\Result\PageFactory $resultPageFactory
     */
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        \Magento\Framework\View\Result\PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
     * Execute action based on request and return result
     *
     * @return \Magento\Backend\Model\View\Result\Page|\Magento\Framework\Controller\Result\Redirect
     */
    public function execute()
    {
        /** @var \Magento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->getConfig()->getTitle()->prepend(__('Edit'));
        $resultPage->setActiveMenu('Kitchen_CustomerData::customer_manage');
        $resultPage->addBreadcrumb(__('customer data'), __('customer data'));
        $resultPage->addBreadcrumb(__('My customer data'), __('My customer data'));

        return $resultPage;
    }
}
