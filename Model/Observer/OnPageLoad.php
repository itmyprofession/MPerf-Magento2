<?php
namespace Tym17\MailPerformance\Model\Observer;

class OnPageLoad
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

    public function getWarning()
    {
        $state = $this->_config->getReadyState();
        switch($state)
        {
            case "fresh-install":
                return __('You\'ve just installed the MailPerformance addon for Magento 2 ! Please consider linking your installation with your MailPerformance Account. Learn how in the documentation');
                break;
            case "bad-xkey":
                return __('MailPerformance: Your XKey is not recognized, please consider verifying it or linking a new one');
                break;
            default:
                return __('MailPerformance: Unknown error, please re-link your XKey. If you still get this message please contact the support.');
                break;
        }
    }

    public function checkOperational()
    {
        if (!$this->_config->isReady())
        {
            $this->_msgManager->addWarning($this->getWarning());
        }
    }
}
