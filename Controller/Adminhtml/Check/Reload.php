<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Reload extends \Magento\Backend\App\Action
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
        if (false)
        {
            $resultRedirect = $this->resultRedirectFactory->create();
            return $resultRedirect->setPath('*/' . $this->getRequest()->getParam('path'));
        }
    }
}
