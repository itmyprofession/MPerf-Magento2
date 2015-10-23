<?php

namespace Tym17\MailPerformance\Model\Resource\Segments;

class Collection extends \Magento\Framework\Model\Resource\Db\Collection\AbstractCollection
{
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Segments', 'Tym17\MailPerformance\Model\Resource\Segments');
        $this->_map['segments']['page_id'] = 'main_table.page_id';
    }
}
