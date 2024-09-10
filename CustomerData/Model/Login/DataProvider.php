<?php
namespace Kitchen\CustomerData\Model\Login; 

  

use Kitchen\CustomerData\Model\ResourceModel\Login\CollectionFactory; 

use Magento\Framework\App\Filesystem\DirectoryList; 

use Magento\Framework\App\Request\Http as Request; 

use Magento\Framework\File\Mime; 

use Magento\Store\Model\StoreManagerInterface; 

/** 

* DataProvider model 

* @SuppressWarnings(PHPMD.CyclomaticComplexity) 

*/ 

class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider 

{ 

    protected $loadedData; 

  

    /** 

     * @var StoreManagerInterface 

     */ 

    private $storeManager; 

  

    /** 

     * @var Request 

     */ 

    protected $request; 

  

    /** 

     * @var WriteInterface 

     */ 

    private $mediaDirectory; 

  

    /** 

     * @var CollectionFactory 

     */ 

    protected $collection; 

  

    /** 

     * @var \Magento\Framework\Filesystem 

     */ 

    private $fileDriver; 

  

    /** 

     * @var \Magento\Framework\Filesystem 

     */ 

    private $_filesystem; 

  

    /** 

     * @var Mime 

     */ 

    private $mime; 

  

    /** 

     * @var array 

     * @param string                                    $name 

     * @param string                                    $primaryFieldName 

     * @param string                                    $requestFieldName 

     * @param CollectionFactory                         $cabinetlineCollectionFactory 

     * @param StoreManagerInterface                     $storeManager 

     * @param Request                                   $request 

     * @param Magento\Framework\Filesystem\Driver\File  $fileDriver 

     * @param Magento\Framework\Filesystem              $filesystem 

     * @param Mime                                      $mime 

     * @param array                                     $meta 

     * @param array                                     $data 

     * @SuppressWarnings(PHPMD.ExcessiveParameterList) 

     */ 

    public function __construct( 

        $name, 

        $primaryFieldName, 

        $requestFieldName, 

        CollectionFactory $collectionFactory, 

        StoreManagerInterface $storeManager, 

        Request $request, 

        \Magento\Framework\Filesystem\Driver\File $fileDriver, 

        \Magento\Framework\Filesystem $filesystem, 

        Mime $mime, 

        array $meta = [], 

        array $data = [] 

    ) { 

        $this->collection   = $collectionFactory->create(); 

        $this->storeManager = $storeManager; 

        $this->request      = $request; 

        $this->fileDriver = $fileDriver; 

        $this->_filesystem = $filesystem; 

        $this->mime = $mime; 

        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data); 

    } 

    /** 

     * Define resource model 

     * 

     * @return array 

     */ 

    public function getData() 

    { 

        if (isset($this->loadedData)) { 

            return $this->loadedData; 

        } 

      
           
             // Check if the customer is subscribed to the newsletter
            //  $'newsletterSubscription' = $product->getNewsletterSubscription() ? 'No' : 'Yes';            
             $this->loadedData[$product->getId()] =$productData;
                   

        return $this->loadedData; 

    } 

  

    /** 

     * Get Meta 

     * 

     * @return $meta 

     */ 

    /*public function getMeta() 

    { 

        $meta = parent::getMeta(); 

        $id = $this->request->getParam('parent_cabinet_line_id'); 

  

        if (isset($id)) { 

            $meta['general_information']['children']['parent_cabinet_line_id']['arguments']['data']['config']['visible'] = true;//phpcs:ignore 

        } else { 

            $meta['general_information']['children']['parent_cabinet_line_id']['arguments']['data']['config']['visible'] = false;//phpcs:ignore 

        } 

        return $meta; 

    }*/ 

  

    /** 

     * Get base media url 

     * 

     * @return string 

     */ 

    public function getMediaUrl() 

    { 

        $mediaUrl = $this->storeManager->getStore() 

            ->getBaseUrl(\Magento\Framework\UrlInterface::URL_TYPE_MEDIA); 

        return $mediaUrl; 

    } 

  

    /** 

     * Get WriteInterface instance 

     * 

     * @return WriteInterface 

     */ 

    private function getMediaDirectory() 

    { 
        if ($this->mediaDirectory === null) { 

            $this->mediaDirectory = $this->_filesystem->getDirectoryWrite(DirectoryList::MEDIA); 

        } 

        return $this->mediaDirectory; 

    } 

} 