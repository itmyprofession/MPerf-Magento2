<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings\Save;

class Events extends \Tym17\MailPerformance\Controller\Settings\Save
{
    /**
     * @return mixed
     */
    public function execute()
    {
        var_dump($this->getRequest()->getPostValue());
        die('events');
    }
}
