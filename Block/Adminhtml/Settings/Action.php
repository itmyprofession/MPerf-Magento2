<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Action extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
    * @param Magento\Backend\Block\Template\Context
    * @param Tym17\MailPerformance\Helper\ConfigHelper
    * @param Tym17\MailPerformance\Helper\RestHelper
    * @param array
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_restHelper = $rest;
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        return false;
    }
}
