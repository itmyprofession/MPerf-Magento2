<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @param Action\Context $context
     */
    public function __construct(
        Action\Context $context
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
        $this->_eventManager->dispatch('mperf_authenticate', ['from' => 'settings']);
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/' . $this->getRequest()->getParam('path'));
    }
}
