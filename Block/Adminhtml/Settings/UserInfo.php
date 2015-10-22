<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class UserInfo extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
    * @param Magento\Backend\Block\Template\Context
    * @param Tym17\MailPerformance\Helper\ConfigHelper
    * @param Tym17\MailPerformance\Helper\RestHelper
    * @param array
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_restHelper = $rest;
    }

    /**
     * @return string
     */
    public function showXKey()
    {
        return 'le';
    }

    public function getActions()
    {
        $result = $this->_restHelper->get('http://backoffice.mailperformance.dev/actions/');
        //var_dump($result);
        $result = $this->_restHelper->legacyInit();
        var_dump($result);
        return 'lel';//$result;
    }

    /**
     * @param  string
     * @return bool
     */
    public function isAllowed($acl)
    {
        $baseAcl = 'Tym17_MailPerformance::';

        return $this->_authorization->isAllowed($baseAcl . $acl);
    }

    /**
     * @return bool
     */
    public function isInfoAllowed()
    {
        $baseAcl = 'Acl_Acc';
        $somethingIsAllowed = $this->isAllowed($baseAcl . 'Name')
            || $this->isAllowed($baseAcl . 'Owner')
            || $this->isAllowed($baseAcl . 'Email')
            || $this->isAllowed($baseAcl . 'Expiration')
            || $this->isAllowed($baseAcl . 'XKey');
        return ($this->isAllowed($baseAcl . 'ountInfo') && $somethingIsAllowed);
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        if (true)//$this->_config->getReadyState() != 'ready')
        {
            return false;
        }
        else
        {
            return true;
        }
    }
}
