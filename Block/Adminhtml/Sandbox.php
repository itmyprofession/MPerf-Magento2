<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Sandbox extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \Tym1è\MailPerformance\Model\Config
     */
    protected $_config;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_restHelper = $rest;
        $this->_config = $objectManager->create('Tym17\MailPerformance\Model\Config');
    }

    public function dostuff()
    {
        return 'l';
    }

}
