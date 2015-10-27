<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

class SaveCart extends \Magento\Backend\App\Action
{
    /**
     * @var string
     */
    const CFG_PATH = 'cart/';

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
        die('cart');
    }
}
