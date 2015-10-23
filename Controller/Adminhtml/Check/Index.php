<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @param Action\Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_eventManager->dispatch('mperf_request', ['from' => 'Check']);
        if ($this->_config->isReady())
        {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/' . $this->getRequest()->getParam('path'));
        }
        else
        {
            $this->messageManager->addWarning(__('Your MailPerformance XKey hasn\'t been validated yet or is not valid anymore'));
            $resultPageFactory = $this->_objectManager->create('Magento\Framework\View\Result\PageFactory');
            $resultPage = $resultPageFactory->create();
            return $resultPage;
        }
    }
}
