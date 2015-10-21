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
    protected $scopeConfig;

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
        $this->scopeConfig = $scopeConfig;
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
        /** @var \MAgento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tym17_MailPerformance::settings');
        $resultPage->addBreadcrumb(__('MailPerformance'), __('MailPerformance'));
        $resultPage->addBreadcrumb(__('Settings'), __('Settings'));
        $resultPage->getConfig()->getTitle()->prepend(__('MailPerformance Settings'));
        return $resultPage;
    }
}
