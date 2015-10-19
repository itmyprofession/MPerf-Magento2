<?php
namespace Tym17\MailPerformance\Model\Resource;

class Config extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_config', 'config_id');
    }
}
