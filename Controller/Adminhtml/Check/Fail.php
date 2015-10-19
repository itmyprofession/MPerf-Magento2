<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Fail extends \Magento\Backend\App\Action
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
        $resultPageFactory = $this->_objectManager->create('Magento\Framework\View\Result\PageFactory');
        $resultPage = $resultPageFactory->create();
        return $resultPage;
    }
}
