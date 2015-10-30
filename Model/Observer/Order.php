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
        \Tym17\MailPerformance\Model\Config $cfg,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        Helper\RestHelper $rest
    ) {
        $this->cfg = $cfg;
        $this->_msgManager = $msgManager;
        $this->_quote = $objectManager->create('\Tym17\MailPerformance\Model\Quote');
        $this->_restHelper = $rest;
    }

    public function bindOnSuccess($observer)
    {
        $data = $observer->getData();
        $orderId = $data['order_ids'][0];

        // FLO
        $dataJson = $this->_quote->getDataFromSqlToFields($orderId);

        $endUrl = 'targets?unicity=';

        foreach ($dataJson as $key => $value)
        {
            $unicity = $this->_quote->getSqlLine('mailperf_fields', 'id', $key);
            if ($unicity[0]['isUnicity'] == 1)
            {
                $endUrl .= $value;
            }
        }

        //On regarde si la cible existe
        $getResponseApi = $this->_restHelper->get($endUrl);

        //Suivant les reponses on fait un PUT ou un POST
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
            //Mettre un message d'erreur : c'est l'appel au /target?unicity qui a cassé
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
