<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Overview;

use Magento\Backend\App\Action\Context;
use Magento\Framework\View\Result\PageFactory;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var PageFactory
     */
     protected $resultPageFactory;

    /**
     * @param Context $context
     * @param PageFactory $resultPageFactory
     */
    public function __construct(
        Context $context,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
    * Index Action
    *
    * @return void
    */
    public function execute()
    {

        /*$this->_view->loadLayout();
        $this->_view->renderLayout();
        /** @var \MAgento\Backend\Model\View\Result\Page $resultPage */
        $resultPage = $this->resultPageFactory->create();
        $resultPage->setActiveMenu('Tym17_MailPerformance::overview');
        $resultPage->addBreadcrumb(__('CMS'), __('CMS'));
        $resultPage->addBreadcrumb(__('Overview'), __('Overview'));
        $resultPage->getConfig()->getTitle()->prepend(__('Overview'));
        return $resultPage;
    }
}
