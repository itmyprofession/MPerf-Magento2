<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use NP6\MailPerformance\Helper;

class UserInfo extends Template
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @var \NP6\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
    * @param \Magento\Backend\Block\Template\Context
    * @param \NP6\MailPerformance\Helper\ConfigHelper
    * @param \NP6\MailPerformance\Helper\RestHelper
    * @param array
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_config = $objectManager->create('NP6\MailPerformance\Model\Config');
        $this->_restHelper = $rest;
    }

    /**
     * @return array
     */
    public function getInfos()
    {
        return ['ACC_NAME' => $this->_config->getConfig('accountName', 'Undefined'),
            'ACC_OWNER' => $this->_config->getConfig('accountUserName', 'Undefined'),
            'ACC_EMAIL' => $this->_config->getConfig('accountEmail', 'Undefined'),
            'ACC_DATE' => substr($this->_config->getConfig('accountExpire', 'Undefined'), 0, -10),
            'ACC_XKEY' => $this->_config->getXKey()];
    }

    /**
     * @param  string
     * @return bool
     */
    public function isAllowed($acl)
    {
        $baseAcl = 'NP6_MailPerformance::';

        return $this->_authorization->isAllowed($baseAcl . $acl);
    }

    /**
     * @return bool
     */
    public function isInfoAllowed()
    {
        $baseAcl = 'Acl_Acc';
        $somethingIsAllowed = $this->isAllowed($baseAcl . 'Name')
            || $this->isAllowed($baseAcl . 'Owner')
            || $this->isAllowed($baseAcl . 'Email')
            || $this->isAllowed($baseAcl . 'Expiration')
            || $this->isAllowed($baseAcl . 'XKey');
        return ($this->isAllowed($baseAcl . 'ountInfo') && $somethingIsAllowed);
    }

    /**
     * @param  string $feature
     * @return string
     */
    public function isFeatureEnabled($feature)
    {
        if ($this->_config->getStoreConfig('cfg/' . $feature) == 0) {
            return __('Disabled');
        }
        return __('Enabled');
    }
}
