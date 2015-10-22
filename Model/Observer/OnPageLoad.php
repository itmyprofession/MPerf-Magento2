<?php
namespace Tym17\MailPerformance\Model\Observer;

class OnPageLoad
{
    protected $_msgManager;


    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager
    ) {
        $this->_msgManager = $msgManager;
    }

    public function getWarning()
    {
        $state = 'lel';
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
        /*if (!$this->_config->isReady())
        {*/
            $this->_msgManager->addWarning($this->getWarning());
        //}
    }
}
