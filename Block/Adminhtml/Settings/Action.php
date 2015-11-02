<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;

class Action extends Template
{
    /**
    * @param \Magento\Backend\Block\Template\Context
    * @param \NP6\MailPerformance\Helper\ConfigHelper
    * @param \NP6\MailPerformance\Helper\RestHelper
    * @param array
    */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getDevUrl()
    {
        return $this->_urlBuilder->getUrl('*/Dev');
    }

    /**
     * @return string
     */
    public function getReloadUrl()
    {
        return $this->_urlBuilder->getUrl('*/Check/Reload', ['path' => 'Settings']);
    }
}
