<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;
use Magento\Framework\App\Config\ScopeConfigInterface;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
     protected $resultPageFactory;

    /**
     * @var scopeConfig
     */
    protected $_config;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
    * Index Action
    *
    * @return void
    */
    public function execute()
    {

        $this->_eventManager->dispatch('mperf_request', ['from' => 'Settings']);
        $resultPage = $this->resultPageFactory->create();
        return $this->_config->checkLinked($resultPage, $this->resultRedirectFactory, 'Settings');
    }
}
