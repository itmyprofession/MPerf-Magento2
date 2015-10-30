<?php

namespace Tym17\MailPerformance\Model\Observer;

use Tym17\MailPerformance\Helper;

class Order
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \Tym17\MailPerformance\Model\quote
     */
    protected $_quote;

    protected $_msgManager;

    public function __construct(
        \Magento\Framework\Message\ManagerInterface $msgManager,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Helper\RestHelper $rest
    ) {
        $this->_msgManager = $msgManager;
        $this->_quote = $objectManager->create('\Tym17\MailPerformance\Model\Quote');
        $this->_restHelper = $rest;
    }

    public function bindOnSuccess($observer)
    {
        $data = $observer->getData();
        $orderId = $data['order_ids'][0];
        var_dump($orderId);

        // FLO
        $dataJson = $this->_quote->getDataFromSqlToFields($orderId);
        echo '<p>' . json_encode($dataJson) . '</p>';

        $endUrl = 'targets?unicity=';

        foreach ($dataJson as $key => $value)
        {
            $unicity = $this->_quote->getSqlLine('mailperf_fields', 'id', $key);
            var_dump($unicity);
            if ($unicity[0]['isUnicity'] == 1)
            {
                $endUrl .= $value;
            }
        }
        echo '<p>' . $endUrl . '</p>';
        $getResponseApi = $this->_restHelper->get($endUrl);
        echo '<p>' . json_encode($getResponseApi) . '</p>';

        if ($getResponseApi['info']['http_code'] == 200 && $getResponseApi['result']['id'])
        {
            echo '<p>PUT</p>';
            $endUrl = 'targets/' . $getResponseApi['result']['id'];
            echo '<p>' . $endUrl . '</p>';
            $getResponseApi = $this->_restHelper->put($endUrl, $dataJson);
        }
        else if ($getResponseApi['info']['http_code'] == 404)
        {
            echo '<p>POST</p>';
            $endUrl = 'targets/';
            $getResponseApi = $this->_restHelper->post($endUrl, $dataJson);
        }
        else
        {
            //Mettre un message d'erreur : c'est l'appel au /target?unicity qui a cassé
        }
        echo '<p>Reponse apres modif/creation de la target : ' . json_encode($getResponseApi) . '</p>';

    }
}
