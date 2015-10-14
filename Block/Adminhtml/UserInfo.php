<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class UserInfo extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\ConfigHelper
     */
    protected $_config;

    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        Helper\ConfigHelper $config,
        Helper\RestHelper $rest,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_config = $config;
        $this->_restHelper = $rest;
    }

    public function showXKey()
    {
        return $this->_config->getXKey();
    }

    public function getActions()
    {
        $result = $this->_restHelper->get('http://backoffice.mailperformance.dev/actions/');
        //var_dump($result);
        $result = $this->_restHelper->legacyInit();
        var_dump($result);
        return 'lel';//$result;
    }

    public function isAllowed($acl)
    {
        $baseAcl = 'Tym17_MailPerformance::';

        return $this->_authorization->isAllowed($baseAcl . $acl);
    }

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
}
