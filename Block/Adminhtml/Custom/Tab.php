<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Custom;

use Magento\Backend\Block\Template;

class Tab extends Template
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
}
