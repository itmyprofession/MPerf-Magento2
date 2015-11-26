<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\Resource;

class Segments extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_segments', 'id');
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _updateSegments($data)
    {
        $nameQuery = 'id = \'' . $data['id'] . '\'';

        /*
        **   Connect to Db then update Segments
        **   ->getConnection() in Magento2/dev branch
        */
        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->update($this->getMainTable(), $data, $nameQuery);
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _createSegments($data)
    {
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(id)"));

        $result = $readAdapter->fetchAll($select);

        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->insertForce($this->getMainTable(), $data);
    }

    /**
     * @return array
     */
    public function getAllSegments()
    {
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable());
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

    /**
     * @param  string $id
     * @return array $result
     */
    public function getSegments($id)
    {
        $pathQuery = 'id = \'' . $id . '\'';
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable())
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return $result;
    }

    /**
     * @param  string $id
     * @param  string $name
     * @return void
     */
    public function saveSegments($id, $name)
    {
        $data = ['id' => $id, 'name' => $name];
        if (!empty($this->getSegments($id)))
        {
            $this->_updateSegments($data);
        }
        else
        {
            $this->_createSegments($data);
        }
    }

    /**
     * @return void
     */
    public function flushSegments()
    {
        $this->_getReadAdapter()->query('TRUNCATE TABLE ' . $this->getMainTable());
    }

    /**
     * @return void
     */
    public function createTableSegments()
    {
        $table = 'CREATE TABLE IF NOT EXISTS mailperf_segments (id INT(11) PRIMARY KEY NOT NULL COMMENT \'Segments Id\', name VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT \'Segments Name\');';
        $this->_getReadAdapter()->query($table);
    }
}
