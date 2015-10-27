<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;

class Action extends Template
{
    /**
    * @param \Magento\Backend\Block\Template\Context
    * @param \Tym17\MailPerformance\Helper\ConfigHelper
    * @param \Tym17\MailPerformance\Helper\RestHelper
    * @param array
    */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    /**
     * @return string
     */
    public function getDevUrl()
    {
        return $this->_urlBuilder->getUrl('*/Dev');
    }

    /**
     * @return string
     */
    public function getReloadUrl()
    {
        return $this->_urlBuilder->getUrl('*/Check/Reload', ['path' => 'Settings']);
    }
}
