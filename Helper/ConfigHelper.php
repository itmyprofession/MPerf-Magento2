<?php
namespace Tym17\MailPerformance\Helper;

class ConfigHelper extends \Magento\Framework\App\Helper\AbstractHelper
{
    /**
     * @param  string param
     */
    public function getConfig($req)
    {
        return $this->scopeConfig->getValue('mailperformance/cfg/' . $req);
    }

    /**
     * @return string
     */
    public function getXKey()
    {
        return $this->scopeConfig->getValue('mailperformance/auth/xkey');
    }
}
