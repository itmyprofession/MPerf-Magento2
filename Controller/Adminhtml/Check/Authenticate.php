<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action;

class Authenticate extends \Magento\Backend\App\Action
{
    /**
     * @var \NP6\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @param  Action\Context $context
     * @return void
     */
    public function __construct(
        Action\Context $context
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
        $this->_restHelper = $this->_objectManager->create('\NP6\MailPerformance\Helper\RestHelper');
    }

    /**
     * @param  mixed $resultRedirect
     * @param  string $error
     * @return mixed
     */
    private function redirectToError($resultRedirect, $error)
    {
        $this->_config->saveConfig('linkstate', 'fail');
        $this->messageManager->addError(__($error));
        return $this->_redirect('*/*/');
    }

    /**
     * @param  array $data
     * @param  array $details
     * @return void
     */
    private function saveContactInfos($data, $details)
    {
        $this->_config->saveConfig('linkstate', 'linked');
        $this->_config->saveConfig('accountId', $data['id']);
        $this->_config->saveConfig('customerLogo', $data['customer']['logo']);
        $this->_config->saveConfig('companyLogo', $data['agency']['logo']);
        $this->_config->saveConfig('accountUserName', $data['firstName'] . ' ' . $data['lastName']);
        $this->_config->saveConfig('accountName', $data['customer']['name']);
        $this->_config->saveConfig('lastAuth', date('d.n.Y'));
        $this->_config->saveConfig('accountEmail', $details['email']);
        if ($details['expire']['isdefined']) {
            $this->_config->saveConfig('accountExpire', $details['expire']['value']);
        }
    }

    /**
     * Authenticate Action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_eventManager->dispatch('mperf_authenticate');
        $resultRedirect = $this->resultRedirectFactory->create();

        /* Get my own infos */
        $result = $this->_restHelper->get('me');
        if ($result['info']['http_code'] < 200 || $result['info']['http_code'] > 299) {
            return $this->redirectToError($resultRedirect,
                'API ' . __('Call') . ' : \'GET\' ' . __('on') . ' \'/me\' ' . __('failed. Please check your XKey'));
        }
        $result = $result['result'];

        /* Get more infos about me */
        $contactResult = $this->_restHelper->get('contacts/' . $result['id']);
        if ($contactResult['info']['http_code'] < 200 || $contactResult['info']['http_code'] > 299) {
            return $this->redirectToError($resultRedirect,
                'API ' . __('Call') . ' : \'GET\' ' . __('on') . ' \'/contacts/' . $result['id'] . '\' ' . __('failed. Please check your XKey'));
        }
        $contactResult = $contactResult['result'];
        $this->saveContactInfos($result, $contactResult);

        /* Final step: Redirect to param page */
        if ($this->_config->isReady()) {
            $this->messageManager->addSuccess(__('You succesfully linked your XKey to Magento2'));
            /* Since we just auth, we now need to generate the mailperformance pre-stored bindings */
            return $this->_redirect('*/Check/Reload', ['path' => $this->getRequest()->getParam('path')]);
        }
        return $this->redirectToError($resultRedirect, __('Unknown error, please try again later'));
    }
}
