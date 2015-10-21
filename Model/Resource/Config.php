<?php
namespace Tym17\MailPerformance\Model\Resource;

class Config extends \Magento\Framework\Model\Resource\Db\AbstractDb
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

        /*
        **   Connect to Db then update config
        **   ->getConnection() in Magento2/dev branch
        */
        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->update($this->getMainTable(), $data, $pathQuery);
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _createConfig($data)
    {
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(config_id)"));
        $result = $readAdapter->fetchAll($select);
        $data['config_id'] = $result[0]['MAX(config_id)'] + 1;
        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->insertForce($this->getMainTable(), $data);
    }

    /**
     * @param  string $path
     * @return array $result
     */
    public function getConfig($path)
    {
        $pathQuery = 'path = \'' . $path . '\'';
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable())
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return $result;
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveConfig($path, $value)
    {
        $data = ['path' => $path, 'value' => $value];
        if (!empty($this->getConfig($path)))
        {
            $this->_updateConfig($data);
        }
        else
        {
            $this->_createConfig($data);
        }
    }
}
