<?php
namespace Tym17\MailPerformance\Model\Resource;

class Config extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('mailperf_config', 'path');
    }

}
