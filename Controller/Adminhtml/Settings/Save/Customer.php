<?php
namespace Tym17\MailPerformance\Controller\Settings\Save;

class Customer extends \Tym17\MailPerformance\Controller\Settings\Save
{
    /**
     * @return mixed
     */
    public function execute()
    {
        var_dump($this->getRequest()->getPostValue());
        die('customer');
    }
}
