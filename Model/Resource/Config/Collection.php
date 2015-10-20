<?php
namespace Tym17\MailPerformance\Model\Resource\Config;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Config', 'Tym17\MailPerformance\Model\Resource\Config');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }
}
