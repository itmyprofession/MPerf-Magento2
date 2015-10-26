<?php
namespace Tym17\MailPerformance\Model;

class Segments extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Resource\Segments');
    }

    /**
     * @return array
     */
    public function getAllSegments()
    {
        return ($this->_getResource()->getAllSegments());
    }

    /**
     * @param  string $path
     * @return string $value
     */
    public function getSegments($path, $default)
    {
        if ($this->isSegments($path))
        {
            $result = $this->_getResource()->getSegments($path);
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
    public function isSegments($path)
    {
        return !empty($this->_getResource()->getSegments($path));
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveSegments($id, $name)
    {
        $this->_getResource()->saveSegments($id, $name);
    }
}
