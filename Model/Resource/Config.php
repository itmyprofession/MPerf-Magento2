<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\Resource;

class Config extends \Magento\Framework\Model\ResourceModel\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_config', 'config_id');
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _updateConfig($data)
    {
        $pathQuery = 'path = \'' . $data['path'] . '\'';

        $connection = $this->getConnection();
        $connection->update($this->getMainTable(), $data, $pathQuery);
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _createConfig($data)
    {
        $connection = $this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(config_id)"));
        $result = $connection->fetchAll($select);
        $data['config_id'] = $result[0]['MAX(config_id)'] + 1;
        $connection->insertForce($this->getMainTable(), $data);
    }

    /**
     * @param  string $path
     * @return array $result
     */
    public function getConfig($path)
    {
        $this->createTableFields();
        $pathQuery = 'path = \'' . $path . '\'';
        $connection =$this->getConnection();
        $select = $connection->select()
            ->from($this->getMainTable())
            ->where($pathQuery);
        $result = $connection->fetchAll($select);
        return $result;
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveConfig($path, $value)
    {
        $this->createTableFields();
        $data = ['path' => $path, 'value' => $value];
        /* if config already exists, update it or create it */
        if (!empty($this->getConfig($path)))
        {
            $this->_updateConfig($data);
        }
        else
        {
            $this->_createConfig($data);
        }
    }

    /**
     * @return void
     */
    public function createTableFields()
    {
        $table = 'CREATE TABLE IF NOT EXISTS ' . $this->getMainTable() . '
            (config_id INT(11) PRIMARY KEY NOT NULL COMMENT \'Config Id\',
            path VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT \'Config path\',
            value VARCHAR(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL COMMENT \'Config value\');';
        $this->getConnection()->query($table);
    }
}
