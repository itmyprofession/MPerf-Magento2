<?php

namespace Tym17\MailPerformance\Model\Resource\Quote;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Quote', 'Tym17\MailPerformance\Model\Resource\Quote');
        $this->_map['quote']['page_id'] = 'main_table.page_id';
    }
}
