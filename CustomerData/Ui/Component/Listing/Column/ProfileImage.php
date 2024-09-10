<?php
 
namespace Kitchen\Gallery\Ui\Component\Listing\Column;
 
use Magento\Framework\View\Element\UiComponentFactory;
use Magento\Framework\View\Element\UiComponent\ContextInterface;
use Magento\Store\Model\StoreManagerInterface;
 
class ProfileImage extends \Magento\Ui\Component\Listing\Columns\Column
{
    /**
     * object of store manger class
     * @var storemanager
     */
    protected $_storeManager;
 
    /**
     * @param ContextInterface      $context
     * @param UiComponentFactory    $uiComponentFactory
     * @param StoreManagerInterface $storemanager
     * @param array                 $components
     * @param array                 $data
     */
    private $urlBuilder;


    public function __construct(
        ContextInterface $context,
        UiComponentFactory $uiComponentFactory,
        StoreManagerInterface $storemanager,
        \Magento\Framework\UrlInterface $urlBuilder,
        array $components = [],
        array $data = []
    ) {
        parent::__construct($context, $uiComponentFactory, $components, $data);
        $this->_storeManager = $storemanager;
        $this->urlBuilder = $urlBuilder;
    }

 
    /**
     * Prepare Data Source
     *
     * @param array $dataSource
     * @return array
     */
    public function prepareDataSource(array $dataSource)
{
    $mediaDirectory = $this->_storeManager->getStore()->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA);
    if (isset($dataSource['data']['items'])) {  
        $fieldName = $this->getData('name');
        foreach ($dataSource['data']['items'] as &$item) {
            // Assuming $item['gallery_id'] contains the customer ID
            $customerId = $item['gallery_id'];
            
            $url = $mediaDirectory.'Kitchen/Gallery/'.$item['image'];
            $item[$fieldName . '_src'] = $url;
            $item[$fieldName . '_alt'] = 'test';
            $item[$fieldName . '_link'] = $this->urlBuilder->getUrl(
                'gallery/gallery/form',
                ['id' => $customerId, 'store' => $this->context->getRequestParam('store')]
            );
            $item[$fieldName . '_orig_src'] = $url;
        }
    }
    return $dataSource;
} 

}
