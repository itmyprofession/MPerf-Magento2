<?php
namespace NP6\MailPerformance\Model\Resource\Config;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('NP6\MailPerformance\Model\Config', 'NP6\MailPerformance\Model\Resource\Config');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }
}
