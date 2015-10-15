<?php
namespace Tym17\MailPerformance\Helper;

use Magento\Framework\App as App;

class ConfigHelper extends App\Helper\AbstractHelper
{
    /**
     * @var string
     */
    const BASE = 'mailperformance/';

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
        return $this->scopeConfig->getValue(self::BASE . 'cfg/' . $req);
    }

    /**
     * @return string
     */
    public function getXKey()
    {
        return $this->scopeConfig->getValue(self::BASE . 'auth/xkey');
    }

    /**
     * @param  string
     * @param  value
     * @return void
     */
    public function setMutant($name, $value)
    {
        $this->scopeConfig->setValue(self::BASE . 'mutant/' . $name, $value);
    }

    /**
     * @param  string
     * @return value
     */
    public function getMutant($name, $asText = false)
    {
        $path = self::BASE . 'mutant/' . $name;
        if ($this->scopeConfig->isSetFlag($path))
        {
            return $this->scopeConfig->getValue($path);
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
