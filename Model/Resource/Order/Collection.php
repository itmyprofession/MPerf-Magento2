<?php

namespace NP6\MailPerformance\Model\Resource\Order;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('NP6\MailPerformance\Model\Order', 'NP6\MailPerformance\Model\Resource\Order');
        $this->_map['quote']['page_id'] = 'main_table.page_id';
    }
}
