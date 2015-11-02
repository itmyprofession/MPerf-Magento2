<?php

namespace Tym17\MailPerformance\Model\Observer;

use Tym17\MailPerformance\Helper;

class SuccessfulOrder
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \Tym17\MailPerformance\Model\quote
     */
    protected $_quote;

    /**
     * @var mixed
     */
    protected $_msgManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager,
        \Tym17\MailPerformance\Model\Config $cfg,
        \Tym17\MailPerformance\Model\Quote $quote,
        Helper\RestHelper $rest
    ) {
        $this->cfg = $cfg;
        $this->_msgManager = $msgManager;
        $this->_quote = $quote;
        $this->_restHelper = $rest;
    }

    public function execute($observer)
    {
        $data = $observer->getData();
        $orderId = $data['order_ids'][0];

        // FLO
        $dataJson = $this->_quote->getDataFromSqlToFields($orderId);

        $endUrl = 'targets?unicity=';

        foreach ($dataJson as $key => $value)
        {
            $result = $this->_quote->getSqlLine('mailperf_fields', 'id', $key);
            if ($result[0]['isUnicity'] == 1)
            {
                $endUrl .= $value;
            }
        }

        /* Check if target exists */
        $getResponseApi = $this->_restHelper->get($endUrl);

        /* perform a POST or PUT action depending on the previous result */
        if ($getResponseApi['info']['http_code'] == 200)
        {
            $endUrl = 'targets/' . $getResponseApi['result']['id'];
            $getResponseApi = $this->_restHelper->put($endUrl, $dataJson);
        }
        else if ($getResponseApi['info']['http_code'] == 404)
        {
            $endUrl = 'targets/';
            $getResponseApi = $this->_restHelper->post($endUrl, $dataJson);
        }
        else
        {
            /* An error message should be there, the API call failed. */
        }
        echo '<p>Reponse apres modif/creation de la target : ' . json_encode($getResponseApi) . '</p>';

        $idSegement = $this->cfg->getConfig('checkoutSuccess/segment', 'none');
        if ($idSegement != 'none')
        {
            $endUrl = 'targets/' . $getResponseApi['result']['id'] . '/segments/' . $idSegement;

            $getResponseApi = $this->_restHelper->post($endUrl, NULL);
        }
    }
}
