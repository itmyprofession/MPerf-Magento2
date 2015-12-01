<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\Resource;

class Fields extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_fields', 'id');
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _updateFields($data)
    {
        $nameQuery = 'id = \'' . $data['id'] . '\'';

        $connection = $this->getConnection();
        $connection->update($this->getMainTable(), $data, $nameQuery);
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _createFields($data)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(id)"));

        $result = $connection->fetchAll($select);
        $connection->insertForce($this->getMainTable(), $data);
    }

    /**
     * @return array
     */
    public function getAllFields()
    {
        $this->createTableFields();
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable());
        $result = $connection->fetchAll($select);
        return ($result);
    }

    /**
     * @param  string $path
     * @return array $result
     */
    public function getFields($id)
    {
        $this->createTableFields();
        $pathQuery = 'id = \'' . $id . '\'';
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable())
            ->where($pathQuery);
        $result = $connection->fetchAll($select);
        return ($result);
    }

    /**
     * @param  string $id
     * @param  string $name
     * @return void
     */
    public function saveFields($data)
    {
        if (!empty($this->getFields($data['id']))) {
            $this->_updateFields($data);
        } else {
            $this->_createFields($data);
        }
    }

    /**
     * @return void
     */
    public function flushFields()
    {
        $this->getConnection()->query('TRUNCATE TABLE ' . $this->getMainTable());
    }

    /**
    * if by anyway the table has been deleted or flushed
     * @return void
     */
    public function createTableFields()
    {
        $table = 'CREATE TABLE IF NOT EXISTS ' . $this->getMainTable() . '
            (id INT(11) PRIMARY KEY NOT NULL COMMENT \'Fields Id\',
            name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT \'Fields Name\',
            type VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT \'Fields Type\',
            isUnicity BOOLEAN NOT NULL COMMENT \'Fields Unicity\');';
        $this->getConnection()->query($table);
    }
}
