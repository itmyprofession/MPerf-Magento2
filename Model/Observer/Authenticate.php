<?php
namespace Tym17\MailPerformance\Model\Observer;

class Authenticate
{
    protected $_msgManager;

    protected $_config;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager,
        \Tym17\MailPerformance\Helper\ConfigHelper $cfg
    ) {
        $this->_config = $cfg;
        $this->_msgManager = $msgManager;
    }

    public function authenticate()
    {
        $this->_config->setReadyState('bad-xkey');
        
        $this->_msgManager->addWarning('tried to auth !');
    }
}
