<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

class SaveCart extends \Magento\Backend\App\Action
{
    /**
     * @return mixed
     */
    public function execute()
    {
        var_dump($this->getRequest()->getPostValue());
        die('cart');
    }
}
