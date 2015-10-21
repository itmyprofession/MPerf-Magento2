<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Dev extends Template
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
        Helper\ConfigHelper $config,
        Helper\RestHelper $rest,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_config = $config;
        $this->_restHelper = $rest;
    }

    /**
    * @return array
    */
    public function dostuff()
    {
        $tmp = $this->_config->getReadyState(); //ok
        $this->_config->setReadyState('bad-xkey'); //ok

        return 'dostuff';
    }

    /**
    * @return array
    */
    public function get($endUrl)
    {
      return ($this->_restHelper->get($endUrl));
    }

}
