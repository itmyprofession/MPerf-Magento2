<?php
namespace Tym17\MailPerformance\Helper;

use Magento\Framework\App as App;

class ConfigHelper extends App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    const BASE = 'mailperformance/';

    /**
     * @var string
     */
    const SCOPE = 'websites';

    /**
     * @param  Magento\Framework\App\Helper\Context
     * @param  Magento\Framework\App\MutableScopeConfig
     * @return void
     */
    public function __construct(
        App\Helper\Context $context,
        App\MutableScopeConfig $mutable
    ) {
        parent::__construct($context);
        /* Allows adding configs */
        $this->scopeConfig = $mutable;
    }

    /**
     * @param  string param
     */
    public function getConfig($req)
    {
        return $this->scopeConfig->getValue(self::BASE . 'cfg/' . $req, self::SCOPE);
    }

    /**
     * @return string
     */
    public function getXKey()
    {
        return $this->scopeConfig->getValue(self::BASE . 'auth/xkey', self::SCOPE);
    }

    /**
     * @return string
     */
    public function getReadyState()
    {
        /*
         * missing-xkey
         * ready
         */
        //return $this->scopeConfig->getValue(self::BASE . 'auth/state', self::SCOPE);
        $state = $this->getMutant('readystate');
        if ($state != null)
        {
            return $state;
        }
        else
        {
            $this->setMutant('readystate', $this->scopeConfig->getValue(self::BASE . 'auth/readystate', self::SCOPE));
            return $this->getMutant('readystate');
        }
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        if ($this->getReadyState() != 'ready')
        {
            return false;
        }
        else
        {
            return true;
        }
    }

    /**
     * @param  stringt
     * @return void
     */
    public function setReadyState($newState)
    {
        //$this->scopeConfig->setValue(self::BASE . 'auth/state', $newState, self::SCOPE);
        $this->setMutant('readystate', $newState);
    }

    /**
     * @param  string
     * @param  value
     * @return void
     */
    public function setMutant($name, $value)
    {
        $this->scopeConfig->setValue(self::BASE . 'mutant/' . $name, $value, self::SCOPE);
    }

    /**
     * @param  string
     * @return value
     */
    public function getMutant($name, $asText = false)
    {
        $path = self::BASE . 'mutant/' . $name;
        if ($this->scopeConfig->isSetFlag($path, self::SCOPE))
        {
            return $this->scopeConfig->getValue($path, self::SCOPE);
        }
        else
        {
            if ($asText)
            {
                return $name . ' is undefined.';
            }
            else
            {
                return null;
            }
        }
    }

    /**
     * @return string
     */
    public function getALKey()
    {
        $xkey = $this->getXKey();
        return substr($xkey, 7);
    }
}
