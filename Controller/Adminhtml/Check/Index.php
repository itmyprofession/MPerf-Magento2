<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Index extends \Magento\Backend\App\Action
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @param Action\Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
    }

    /**
     * If plugin is locked, will return this page
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
