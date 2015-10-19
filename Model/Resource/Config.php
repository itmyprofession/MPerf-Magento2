<?php
namespace Tym17\MailPerformance\Model\Resource;

class Config extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * Initialize resource model
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_config', 'config_id');
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveConfig($path, $value)
    {
        var_dump($this);
        $connection = $this->getConnection();
        $data = [];
        $data[] = ['path' => $path, 'value' => $value];
        var_dump($connection);
        $connection->insertOnDuplicate($this->getMainTable(), $data, ['value']);
    }
}
