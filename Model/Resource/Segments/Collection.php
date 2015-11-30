<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\Resource\Segments;

class Collection extends \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NP6\MailPerformance\Model\Segments', 'NP6\MailPerformance\Model\Resource\Segments');
        $this->_map['segments']['page_id'] = 'main_table.page_id';
    }
}
