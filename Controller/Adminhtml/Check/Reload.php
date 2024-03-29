<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Reload extends \Magento\Backend\App\Action
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @param  Action\Context $context
     * @return void
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
    }

    /**
     * Reload components
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $fields = $this->_objectManager->create('\NP6\MailPerformance\Model\Fields');
        $segments = $this->_objectManager->create('\NP6\MailPerformance\Model\Segments');
        if (!$fields->populateFields() || !$segments->populateSegments()) {
            $this->messageManager->addWarning(__('Failed reloading your MailPerformance components'));
        }
        else {
            $this->messageManager->addSuccess(__('Succesfully reloaded your MailPerformance components'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $this->_redirect('*/Check/Index', [ 'path' => $this->getRequest()->getParam('path')]);
    }
}
