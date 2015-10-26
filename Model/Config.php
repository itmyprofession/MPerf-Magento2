<?php
namespace Tym17\MailPerformance\Model;

class Config extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var string
     */
    const BASE = 'mailperformance/';

    /**
     * @var string
     */
    const SCOPE = 'default';

    /**
     * @var \Magento\Framework\App\MutableScopeConfig
     */
    protected $_config;

    /**
    * @param  \Magento\Framework\Model\Context $context
    * @param  \Magento\Framework\Registry $registry
    * @param  \Magento\Framework\App\ScopeConfig $cfg
    * @param  \Magento\Framework\Model\Resource\AbstractResource $resource = null
    * @param  \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
    * @param  array $data = []
    * @return void
    */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\App\MutableScopeConfig $cfg,
        \Magento\Framework\Model\Resource\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_config = $cfg;
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

    /**
     * @return string
     */
    public function getReadyState()
    {
        return $this->getConfig('linkstate', 'post-install');
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        if ($this->getReadyState() == 'linked')
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    /**
     * @return string
     */
    public function getXKey()
    {
        return $this->_config->getValue(self::BASE . 'auth/xkey', self::SCOPE);
    }

    /**
     * @return string
     */
    public function getALKey()
    {
        $xkey = $this->getXKey();
        return substr($xkey, 7);
    }

    /**
     * @param  string $path
     * @return mixed
     */
    public function getStoreConfig($path)
    {
        return $this->_config->getValue(self::BASE . $path, self::SCOPE);
    }

    /**
     * / ! \ Only use this from a Controller / ! \
     * / ! \ Every Non-Check Controller should return this function / ! \
     * Redirection to the Auth page incase the user
     * forces Magento to load XKey-Link required pages
     * @param  mixed $result
     * This is what the controller is mean to return, either Redirect or Page
     * @param  mixed $redirectFactory
     * @param  string $calledUrl
     * @return mixed $result
     */
     public function checkLinked($result, $redirectFactory, $calledUrl)
     {
        if (!$this->isReady())
        {
            /* Since XKey is not linked, we redirect to the Auth Page */
            $result = $redirectFactory->create();
            $result = $result->setPath('*/Check', ['path' => $calledUrl]);
        } /* else we don't touch result and return it since the XKey is linked */
        return $result;
     }
}
