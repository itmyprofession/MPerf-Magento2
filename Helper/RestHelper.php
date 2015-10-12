<?php
namespace Tym17\MailPerformance\Helper;

use Magento\Framework\App as App;

class RestHelper extends \Magento\Framework\App\Helper\AbstractHelper
{

    const REST_GET = 'GET';
    const REST_PUT = 'PUT';
    const REST_POST = 'POST';

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
    protected function init($url)
    {
        $init = curl_init();
        curl_setopt($init, CURLOPT_URL, $url);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        return $init;
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return array
     */
    protected function act($kind, $url, $dataJson)
    {
        /* Prepairing request and it's header */
        $request = $this->init($url);
        $headerArray = array(
            'X-Key: ' . $this->_xkey,
            'Content-Type: application/json');
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, $kind);

        /* if POST/PUT request, add Json parameters */
        if ($dataJson != null)
        {
            curl_setopt($request, CURLOPT_POSTFIELDS, $dataJson);
            array_push($headerArray, 'Content-Length: ' . strlen($dataJson));
        }

        /* filling header with Xkey and options */
        curl_setopt($request, CURLOPT_HTTPHEADER, $headerArray);

        /* Executing request */
        $result = curl_exec($request);

        /* Prepairing return variables */
        $resultArray = array('request' => $request, 'result' => $result);

        /* if POST/PUT request, retrieve data response */
        if ($dataJson != null)
        {
            array_push($resultArray, 'info' => curl_getinfo($request));
        }

        return $resultArray;
    }

    public function get($url)
    {
        return 'hello';//$this->act(self::REST_GET, $url, null);
    }
}
