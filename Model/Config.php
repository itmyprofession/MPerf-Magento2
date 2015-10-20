<?php
namespace Tym17\MailPerformance\Model;

class Config extends \Magento\Framework\Model\AbstractModel
{

    /**
     * @param  array $data
     * @return void
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

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
        return $this;
    }
}
