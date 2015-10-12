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
     * @return curl request
     */
    protected function init($url)
    {
        $init = curl_init();
        curl_setopt($init, CURLOPT_URL, $url);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        return $init;
    }

    /**
     * @param  string
     * @param  string
     * @param  string
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
            $headerArray[] = 'Content-Length: ' . strlen($dataJson);
        }

        /* filling header with Xkey and options */
        curl_setopt($request, CURLOPT_HTTPHEADER, $headerArray);

        /* Executing request and retrieveing infos about the request */
        $result = curl_exec($request);
        $info = curl_getinfo($request);

        /* Prepairing return variables */
        var_dump($result);
        $resultArray = array('result' => $result, 'info' => $info);

        curl_close($request);
        return $resultArray;
    }

    /**
     * @param  string
     * @return array
     */
    public function get($url)
    {
        return $this->act(self::REST_GET, $url, null);
    }

    /**
     * @param  string
     * @param  array
     * @return array
     */
    public function post($url, $data)
    {
        $dataJson = json_encode($data);
        return $this->act(self::REST_POST, $url, $dataJson);
    }

    /**
     * @param  string
     * @return array
     */
    public function convertFromJson($json)
    {
        /* clean the json string to make a valid json */
        $json = preg_replace('/new\ Date\(([0-9]+)\)/', '$1', $json);
        return json_decode($json, true);
    }
}
