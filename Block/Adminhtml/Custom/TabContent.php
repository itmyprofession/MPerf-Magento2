<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Custom;

use Magento\Backend\Block\Template;

class TabContent extends Template
{
    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getContent()
    {
        return 'content';
    }

    public function getTabId()
    {
        return $this->_nameInLayout;
    }
}
