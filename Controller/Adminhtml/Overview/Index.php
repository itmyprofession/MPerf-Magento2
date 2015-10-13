<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Overview;

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
        /** @var \MAgento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tym17_MailPerformance::overview');
        $resultPage->addBreadcrumb(__('Marketing'), __('Marketing'));
        $resultPage->addBreadcrumb(__('MailPerformance'), __('MailPerformance'));
        $resultPage->addBreadcrumb(__('Overview'), __('Overview'));
        $resultPage->getConfig()->getTitle()->prepend(__('MailPerformance Overview'));

        return $resultPage;
    }
}
