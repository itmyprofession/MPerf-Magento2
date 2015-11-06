<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Controller\Adminhtml\Settings;

class Dump extends \Magento\Backend\App\Action
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @return mixed
     */
    public function execute()
    {
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
        $toSave = $this->getRequest()->getPostValue();
        var_dump($toSave);
    }
}
