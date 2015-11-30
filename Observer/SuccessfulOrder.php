<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Observer;

use NP6\MailPerformance\Helper;
use Magento\Framework\Event\Observer as EventObserver;
use Magento\Framework\Event\ObserverInterface;

class SuccessfulOrder implements ObserverInterface
{
    /**
     * @var \NP6\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \NP6\MailPerformance\Model\quote
     */
    protected $_quote;

    /**
     * @var mixed
     */
    protected $_msgManager;

    /**
     * @param  \Magento\Framework\Message\ManagerInterface $msgManager
     * @param  \NP6\MailPerformance\Model\Config $cfg
     * @param  \NP6\MailPerformance\Model\Order $quote
     * @param  Helper\RestHelper $rest
     * @return void
     */
    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager,
        \NP6\MailPerformance\Model\Config $cfg,
        \NP6\MailPerformance\Model\Order $quote,
        Helper\RestHelper $rest
    ) {
        $this->cfg = $cfg;
        $this->_msgManager = $msgManager;
        $this->_quote = $quote;
        $this->_restHelper = $rest;
    }

    /**
     * @param  EventObserver $observer
     * @return void
     */
    public function execute(EventObserver $observer)
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
            /* An error message should be there, the API call failed. However no need to show it to the customer*/
        }

        $idSegement = $this->cfg->getConfig('checkoutSuccess/segment', 'none');
        if ($idSegement != 'none')
        {
            $endUrl = 'targets/' . $getResponseApi['result']['id'] . '/segments/' . $idSegement;

            $getResponseApi = $this->_restHelper->post($endUrl, NULL);
        }
    }
}
