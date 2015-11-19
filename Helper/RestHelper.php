<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Helper;

use Magento\Framework\App as App;

class RestHelper extends App\Helper\AbstractHelper
{
    const REST_GET = 'GET';
    const REST_PUT = 'PUT';
    const REST_POST = 'POST';
    const MPERF_URL = 'http://http://v8.mailperformance.com/';

    /**
     * @var string
     */
    protected $_xkey;

    /**
     * @var \Magento\Framework\Message\ManagerInterface
     */
    protected $messageManager;

    /**
     * @param  \Magento\Framework\App\Helper\Context $Context
     * @param  \Magento\Framework\Message\ManagerInterface $msgManager
     * @return void
     */
    public function __construct(
        App\Helper\Context $context,
        \Magento\Framework\Message\ManagerInterface $msgManager
    ) {
        parent::__construct($context);
        $this->_xkey = $this->scopeConfig->getValue('mailperformance/auth/xkey');
        $this->messageManager = $msgManager;
    }

    /**
     * @param string
     * @return mixed
     */
    protected function init($url)
    {
        $init = curl_init();
        curl_setopt($init, CURLOPT_URL, $url);
        curl_setopt($init, CURLOPT_RETURNTRANSFER, true);
        return $init;
    }

    /**
     * @return array
     */
    public function legacyInit()
    {
        /* == Legacy login parameters == */
        /* You might occasionally see "status :" "failure" but don't worry,
        ** if you check the Json output you'll see it is because you are
        ** trying to login multiples times */
        $post_content = array(
            'method' => array(
                'name' => 'authenticateFromAutoLoginKey',
                'version' => 1
            ),
            'parameters' => array(
                'alKey' => substr($this->_xkey, 7)
            ),
            'debug' => array(
                'forceSync' => true
            )
        );
        return $this->post(self::MPERF_URL . 'api/auth', $post_content);
    }

    /**
     * / ! \ Changing notice will also change return type / ! \
     * @param  string $kind
     * @param  string $url
     * @param  array $dataJson
     * @param  bool $notice
     * @return array
     */
    protected function act($kind, $url, $dataJson = [], $notice = 0)
    {
        /* Prepairing request and it's header */
        $request = $this->init($url);
        $headerArray = array(
            'X-Key: ' . $this->_xkey,
            'Content-Type: application/json');
        curl_setopt($request, CURLOPT_CUSTOMREQUEST, $kind);

        /* if POST/PUT request, add Json parameters */
        if (!empty($dataJson))
        {
            $data = json_encode($dataJson);
            curl_setopt($request, CURLOPT_POSTFIELDS, $data);
            $headerArray[] = 'Content-Length: ' . strlen($data);
        }
        if (empty($dataJson) && ($kind == self::REST_POST || $kind == self::REST_PUT))
        {
            $headerArray[] = 'Content-Length: 0';
        }

        /* filling header with Xkey and options */
        curl_setopt($request, CURLOPT_HTTPHEADER, $headerArray);

        /* Executing request and retrieveing infos about the request */
        $result = curl_exec($request);
        $info = curl_getinfo($request);

        /* Prepairing return variables */
        $result = $this->convertFromJson($result);
        $resultArray = array('result' => $result, 'info' => $info);

        curl_close($request);
        /* Notice user about the error and return json array of result or null if error */
        if ($notice > 0)
        {
            if ($resultArray['info']['http_code'] != 200 && $resultArray['info']['http_code'] != 204 && $notice > 0)
            {
                $text = '<p>Error ' . $tab['info']['http_code'] . ' : ""' . $kind . '"" on ' . $endUrl . ' failed.</p>';
                if ($notive == 2)
                {
                    /* shows up a fancy message on the [next] loading[/ed] page */
                    $this->messageManager->addWarning($text);
                }
                else if ($notice == 1)
                {
                    /* Directly echo the error on the page */
                    echo $text;
                }
                return (null);
            }
            return json_encode($resultArray['result']);
        }
        /* Returns an array with all the details, including error results */
        return $resultArray;
    }

    /**
     * @param  string
     * @param  int
     * @return string|array
     */
    public function get($endUrl, $notice = 0)
    {
      return $this->act(self::REST_GET, self::MPERF_URL . $endUrl, [ ], $notice);
    }

    /**
     * @param  string
     * @param  array
     * @param  int
     * @return string|array
     */
    public function post($endUrl, $data, $notice = 0)
    {
        return $this->act(self::REST_POST, self::MPERF_URL . $endUrl, $data, $notice);
    }

    /**
     * @param  string
     * @param  array
     * @param  int
     * @return string|array
     */
    public function put($endUrl, $data, $notice = 0)
    {
        return $this->act(self::REST_PUT, self::MPERF_URL . $endUrl, $data, $notice);
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
