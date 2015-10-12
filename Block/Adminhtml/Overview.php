<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper\ConfigHelper;
use Tym17\MailPerformance\Helper\RestHelper;

class Overview extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\ConfigHelper
     */
    protected $_config;

    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        ConfigHelper $config,
        RestHelper $rest,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_config = $config;
        $this->_restHelper = $rest;
    }

    public function showXKey()
    {
        return $this->_config->getXKey();
    }

    public function getActions()
    {
        return 'hello';
    }
}
