<?php
namespace Tym17\MailPerformance\Model;

class Config extends \Magento\Framework\Model\AbstractModel
{
    const LOGIN_STATE = 0;

    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Resource\Config');
    }

    public function saveConfig($path, $value)
    {
        //try {
            $this->setId($path);
            $this->setData('value', $value);
            $this->save();
        //} catch (\Exception $e) {

        //}
    }
}
