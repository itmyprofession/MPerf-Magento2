<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;

class Overview extends Template
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

    public function hellotest()
    {
        return 'kikou';
    }
}
