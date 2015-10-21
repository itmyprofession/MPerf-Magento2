<?php
namespace Tym17\MailPerformance\Model\Resource;

class Config extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    protected function _construct()
    {
        $this->_init('mailperf_config', 'config_id');
    }

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

    public function isConfig($path)
    {
        $pathQuery = 'path = \'' . $path . '\'';
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()->from($this->getMainTable())->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return !empty($result);
    }

    public function saveConfig($path, $value)
    {
        $data = ['path' => $path, 'value' => $value];
        var_dump($this->isConfig($path));
        $this->_updateConfig($data);
    }
}
