<?php
namespace Tym17\MailPerformance\Adminhtml\Forms;

class Index extends \MAgento\Backend\App\Action
{
    /**
    * Index Action*
    * @return void
    */
    public function execute()
    {
        $this->_eventManager->dispatch('mperf_request', ['from' => 'Forms']);
        die('hello world!')
    }
}
