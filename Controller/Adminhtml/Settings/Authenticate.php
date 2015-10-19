<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

use Magento\Backend\App\Action;

class Authenticate extends \Magento\Backend\App\Action
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
        $cfg = $this->_objectManager->create('\Tym17\MailPerformance\Helper\ConfigHelper');
        $this->_eventManager->dispatch('mperf_authenticate');
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/Settings');
    }
}
