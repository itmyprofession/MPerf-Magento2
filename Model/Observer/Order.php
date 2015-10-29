<?php
namespace Tym17\MailPerformance\Model\Observer;

class Order
{
    protected $_msgManager;


    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager
    ) {
        $this->_msgManager = $msgManager;
    }

    public function checkout_submit_all_after($obj)
    {
        $this->_msgManager->addWarning(__('Cocacola '));
        //file_put_contents('plswork', 'EVENT:' . $obj . PHP_EOL, FILE_APPEND);
    }
}
