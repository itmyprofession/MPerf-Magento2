<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Controller\Adminhtml\Settings;

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
    protected $_config;

    /**
     * @param  Context $context
     * @param  ScopeConfigInterface $scopeConfig
     * @param  PageFactory $resultPageFactory
     * @return void
     */
    public function __construct(
        Context $context,
        ScopeConfigInterface $scopeConfig,
        PageFactory $resultPageFactory
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
        $this->resultPageFactory = $resultPageFactory;
    }

    /**
    * Index Action
    *
    * @return void
    */
    public function execute()
    {

        $this->_eventManager->dispatch('mperf_request', ['from' => 'Settings']);
        $resultPage = $this->resultPageFactory->create();
        return $this->_config->checkLinked($resultPage, $this->resultRedirectFactory, 'Settings');
    }
}
