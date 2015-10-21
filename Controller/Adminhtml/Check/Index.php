<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @param Action\Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_eventManager->dispatch('mperf_request', ['from' => 'settings']);
        if (false)
        {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/' . $this->getRequest()->getParam('path'));
        }
        else
        {
            $resultPageFactory = $this->_objectManager->create('Magento\Framework\View\Result\PageFactory');
            $cfg = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
            $cfg->saveConfig('lfel', 'dfsddsfdsg');
            $cfg->saveConfig('az', 'ddfgfffffeaz');
            $resultPage = $resultPageFactory->create();
            return $resultPage;
        }
    }
}
