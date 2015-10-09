<?php
namespace Tym17\MailPerformance\Helper;

use Magento\Framework\App as App;

class RestHelper extends \Magento\Framework\App\Helper\AbstractHelper
{

    const REST_GET = 'GET';
    const REST_PUT = 'PUT';
    const REST_POST = 'POST';

    protected $_request;

    /**
     * @var string
     */
    protected $_xkey;

    public function __construct(
        App\Helper\Context $context
    ) {
        parent::__construct($context);
        $this->_xkey = $this->scopeConfig->getValue('mailperformance/auth/xkey');
    }

    /**
     * @param string
     */
    private function init($url)
    {
        $init = curl_init();
        curl_setopt($init, CURLOPT_URL, $url);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        $this->_request = $init;
        $this->_url = $url;
    }

    private function act($kind, $datajson = null)
    {
        //core function
    }

    public function get/put/post($url/$json)
    {
        //init
        //act();
        //return;
    }
}
