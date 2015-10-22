<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Check extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_restHelper = $rest;
        $this->_objectManager = $objectManager;
    }

    /**
     * @return string
     */
    public function getAuthUrl()
    {
        return $this->_urlBuilder->getUrl('*/*/Authenticate', ['path' => $this->getRequest()->getParam('path')]);
    }

    /**
     * @return bool
     */
    public function haveConfigAccess()
    {
        return($this->_authorization->isAllowed('Magento_Backend::stores_settings')
            && $this->_authorization->isAllowed('Magento_Config::config')
            && $this->_authorization->isAllowed('Tym17_MailPerformance::config'));
    }

}
