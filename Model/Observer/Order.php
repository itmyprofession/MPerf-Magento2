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

    public function placeOrder()
    {
        echo '<p>placeOrder</p>';
    }
}
