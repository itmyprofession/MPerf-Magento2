<?php
namespace Tym17\MailPerformance\Model;

class Config extends \Magento\Framework\Model\AbstractModel
{
    /**
     * Init resource Model
     *
     * @return void
     */
    protected function _construct()
    {
        //$this->_init('Tym17\MailPerformance\Model\Resource\Config');
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return $this
     */
    public function saveConfig($path, $value)
    {
        //$this->_getResource()->saveConfig($path, $value);
        return $this;
    }
}
