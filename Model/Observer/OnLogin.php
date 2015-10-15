<?php
namespace Tym17\MailPerformance\Model\Observer;

class OnLogin
{
    protected $_msgManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager
    ) {
        $this->_msgManager = $msgManager;
    }


    public function checkOperational()
    {
        $this->_msgManager->addWarning("hello this is me");
    }
}
