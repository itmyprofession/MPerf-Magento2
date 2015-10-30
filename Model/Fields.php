<?php
namespace Tym17\MailPerformance\Model;

class Fields extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_rest;

    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
    protected $cfg;

    /**
    * @param  \Magento\Framework\Model\Context $context
    * @param  \Magento\Framework\Registry $registry
    * @param  \Tym17\MailPerformance\Helper\RestHelper $rest
    * @param  \Magento\Framework\Model\Resource\AbstractResource $resource = null
    * @param  \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
    * @param  array $data = []
    * @return void
    */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Tym17\MailPerformance\Helper\RestHelper $rest,
        \Tym17\MailPerformance\Model\Config $cfg,
        \Magento\Framework\Model\Resource\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_rest = $rest;
        $this->cfg = $cfg;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tym17\MailPerformance\Model\Resource\Fields');
    }

    /**
     * @return bool
     */
    public function populateFields()
    {
        $this->_getResource()->createTableFields();

        $this->_getResource()->flushFields();
        /* Make REST request */
        $result = $this->_rest->get('fields/');

        /* Check if everything went fine or lock down the module*/
        if ($result['info']['http_code'] < 200 || $result['info']['http_code'] > 299)
        {
            $this->cfg->saveConfig('linkstate', 'unvalid');
            return false;
        }

        /* Populate DB */
        $tab = $result['result'];
        foreach ($tab as $elem)
        {
            /* $data = ['id' => $id, 'name' => $name, 'isUnicity' => $unicity]; */
            $this->saveFields([
                'id' => $elem['id'],
                'name' => $elem['name'],
                'isUnicity' => $elem['isUnicity'],
                'type' => $elem['type']]);
        }
        return true;
    }

    /**
     * @return array
     */
    public function getAllFields()
    {
        return ($this->_getResource()->getAllFields());
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
        $this->_getResource()->saveFields(['id' => $id, 'name' => $name, 'isUnicity' => $unicity]);
    }

    /**
     * @return void
     */
    public function flushFields()
    {
        $this->_getResource()->flushFields();
    }
}
