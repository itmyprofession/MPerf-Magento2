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
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_restHelper = $rest;
    }

    public function dostuff()
    {
        return 'l';
    }

}
