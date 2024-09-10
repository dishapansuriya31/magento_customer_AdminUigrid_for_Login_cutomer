<?php
namespace Kitchen\CustomerData\Controller\Adminhtml\Index;
 
use Magento\Framework\App\Action\HttpPostActionInterface;
use Kitchen\CustomerData\Model\LoginFactory;
 
class Delete extends \Magento\Backend\App\Action implements HttpPostActionInterface
{
    
 
    protected $LoginFactory;
 
    public function __construct(
        \Magento\Backend\App\Action\Context $context,
        LoginFactory $LoginFactory,
    ) {
        parent::__construct($context);
        $this->LoginFactory = $LoginFactory;
    }
 
    public function execute()
    {
        $id = $this->getRequest()->getParam('entity_id');
       // $resultRedirect = $this->resultRedirectFactory->create();
        
        if ($id) {
            try {
                
                $pageModel = $this->LoginFactory->create()->load($id);
                $pageModel->delete();
                
                $this->messageManager->addSuccessMessage(__('The data has been deleted.'));
               
            } catch (\Exception  $e) {
                $this->messageManager->addErrorMessage($e->getMessage());
             
            }
        }
        
        $this->messageManager->addErrorMessage(__('We can\'t find a page to delete.'));
       $this->_redirect('customerdata/index/index');
    }
}
