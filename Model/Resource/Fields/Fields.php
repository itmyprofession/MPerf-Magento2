<?php
namespace NP6\MailPerformance\Model\Resource\Fields;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('NP6\MailPerformance\Model\Fields', 'NP6\MailPerformance\Model\Resource\Fields');
        $this->_map['fields']['page_id'] = 'main_table.page_id';
    }
}
