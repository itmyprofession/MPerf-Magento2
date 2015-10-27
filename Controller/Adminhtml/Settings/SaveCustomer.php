<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

class SaveCustomer extends \Magento\Backend\App\Action
{
    /**
     * @var string
     */
    const CFG_PATH = 'customer/';

    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @return mixed
     */
    public function execute()
    {
        $toSave = $this->getRequest()->getPostValue();
        var_dump($toSave);
        die('customer');
    }
}
