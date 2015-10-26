<?php
namespace Tym17\MailPerformance\Model;

class Fields extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Resource\Fields');
    }

    /**
     * @param  string $path
     * @return string $value
     */
    public function getFields($path, $default)
    {
        if ($this->isFields($path))
        {
            $result = $this->_getResource()->getFields($path);
            return $result[0];
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
    public function isFields($path)
    {
        return !empty($this->_getResource()->getFields($path));
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveFields($id, $name, $unicity)
    {
        $this->_getResource()->saveFields($id, $name, $unicity);
    }
}
