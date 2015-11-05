<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Controller\Adminhtml\Settings;

use Magento\Backend\App\Action\Context;

class ValueList extends \Magento\Backend\App\Action
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
        $resultPageFactory = $this->_objectManager->create('Magento\Framework\View\Result\PageFactory');
        $resultPage = $resultPageFactory->create();
        return $this->_config->checkLinked($resultPage, $this->resultRedirectFactory, 'Settings/valuelist');
    }
}
