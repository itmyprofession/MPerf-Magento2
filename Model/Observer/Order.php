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

    public function bindOnSuccess($observer)
    {
        $data = $observer->getData();
        $orderId = $data['order_ids'][0];
        var_dump($orderId);
        
    }
}
