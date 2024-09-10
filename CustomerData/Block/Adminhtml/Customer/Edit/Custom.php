<?php
namespace Kitchen\CustomData\Block\Adminhtml\Customer\Edit;

use Magento\Backend\Block\Template\Context;
use Magento\Backend\Helper\Data;
use Magento\Customer\Controller\RegistryConstants;
use Magento\Framework\Registry;
use Kitchen\CustomerData\Model\ResourceModel\Login\CollectionFactory as LoginCollectionFactory;

class Custom extends \Magento\Backend\Block\Widget\Grid\Extended
{
    protected $_coreRegistry = null;

    protected $loginCollectionFactory;

    public function __construct(
        Context $context,
        Data $backendHelper,
        LoginCollectionFactory $loginCollectionFactory,
        Registry $coreRegistry,
        array $data = []
    ) {
        $this->_coreRegistry = $coreRegistry;
        $this->loginCollectionFactory = $loginCollectionFactory;
        parent::__construct($context, $backendHelper, $data);
    }

    protected function _construct()
    {
        parent::_construct();
        $this->setId('view_custom_grid');
        $this->setDefaultSort('login_date', 'desc'); // Sort by login date by default
        $this->setPagerVisibility(true); // Enable pagination if necessary
        $this->setFilterVisibility(true); // Enable filters if necessary
    }

    protected function _prepareCollection()
    {
        $customerId = $this->_coreRegistry->registry(RegistryConstants::CURRENT_CUSTOMER_ID);
        $collection = $this->loginCollectionFactory->create()
            ->addFieldToFilter('customer_id', $customerId); // Filter by current customer ID
        $this->setCollection($collection);
        return parent::_prepareCollection();
    }

    protected function _prepareColumns()
    {
        $this->addColumn(
            'entity_id',
            ['header' => __('ID'), 'index' => 'entity_id', 'type' => 'number', 'width' => '50px']
        );
        $this->addColumn(
            'customer_email',
            [
                'header' => __('Customer Email'),
                'index' => 'customer_email',
            ]
        );
        $this->addColumn(
            'login_date',
            [
                'header' => __('Login Date'),
                'index' => 'login_date',
                'type' => 'datetime',
            ]
        );
        return parent::_prepareColumns();
    }

    public function getHeadersVisibility()
    {
        return $this->getCollection()->getSize() > 0;
    }

    public function getRowUrl($row)
    {
        // No row action, so return false. Modify this if you need a row action.
        return false;
    }
}
