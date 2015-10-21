<?php
namespace Tym17\MailPerformance\Model;

class Config extends \Magento\Framework\Model\AbstractModel
{
    const LOGIN_STATE = 0;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Resource\Config');
    }

    /**
     * @param  string $path
     * @return string $value
     */
    public function getConfig($path, $default)
    {
        if ($this->isConfig($path))
        {
            $result = $this->_getResource()->getConfig($path);
            return $result[0]['value'];
        }
        else
        {
            return $default;
        }
    }

    /**
     * @param  string $path
     * @return bool
     */
    public function isConfig($path)
    {
        return !empty($this->_getResource()->getConfig($path));
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveConfig($path, $value)
    {
        if ($this->getConfig($path, 'NoConfigDefined') != $value)
        {
            $this->_getResource()->saveConfig($path, $value);
        }
    }
}
