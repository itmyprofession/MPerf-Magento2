<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

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
        $this->messageManager->addSuccess(__('You succesfully linked your XKey to your Magento2 install'));
        $cfg = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
        $cfg->saveConfig('linkstate', 'linked');
        $this->_eventManager->dispatch('mperf_authenticate');
        $resultRedirect = $this->resultRedirectFactory->create();
        if ($cfg->getConfig('linkstate', 'notlinked') == 'linked')
        {
            return $resultRedirect->setPath('*/' . $this->getRequest()->getParam('path'));
        }
        else
        {
            return $resultRedirect->setPath('*/*/');
        }
    }
}
