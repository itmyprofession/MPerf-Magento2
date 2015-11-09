<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\Resource;

class Order extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('quote', NULL);
    }

    /**
    * @param  string
    * @param  string
    * @param  string
    * @param  string
    * @return array
    */
    public function getSqlColumn($nameTable, $namePrimaryKey, $valuePrimaryKey, $nameColumn)
    {
        $pathQuery = $namePrimaryKey . ' = \'' . $valuePrimaryKey . '\'';
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select($nameColumn)
            ->from($nameTable)
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

    /**
    * @param  string
    * @param  string
    * @param  string
    * @return array
    */
    public function getSqlLine($nameTable, $namePrimaryKey, $valuePrimaryKey)
    {
        $pathQuery = $namePrimaryKey . ' = \'' . $valuePrimaryKey . '\'';
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($nameTable)
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

}
