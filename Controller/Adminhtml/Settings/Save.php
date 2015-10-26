<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

use Magento\Backend\App\Action;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \Tym17\MailPerformance\Model\Config
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
        $this->_config = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
        $this->_restHelper = $this->_objectManager->create('\Tym17\MailPerformance\Helper\RestHelper');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $this->_eventManager->dispatch('mperf_settings_save');
        $resultRedirect = $this->resultRedirectFactory->create();

        if (false)
        {
            $this->messageManager->addSuccess(__('You succesfully saved your prefrences'));
            return $resultRedirect->setPath('*/*/');
        }
        var_dump($this->getRequest()->getPostValue());
    }
}
