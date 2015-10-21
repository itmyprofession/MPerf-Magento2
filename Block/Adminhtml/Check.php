<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Check extends Template
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
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        Helper\ConfigHelper $config,
        Helper\RestHelper $rest,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_config = $config;
        $this->_restHelper = $rest;
        $this->_objectManager = $objectManager;
    }

    public function getAuthUrl()
    {
        return $this->_urlBuilder->getUrl('*/*/Authenticate', []);
    }

}
