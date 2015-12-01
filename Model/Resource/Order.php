<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\Resource;

class Order extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('quote', null);
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
        $connection = $this->getConnection();
        $select = $connection->select($nameColumn)
            ->from($this->getTable($nameTable))
            ->where($pathQuery);
        $result = $connection->fetchAll($select);
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
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getTable($nameTable))
            ->where($pathQuery);
        $result = $connection->fetchAll($select);
        return ($result);
    }

}
