<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Check;

use Magento\Backend\App\Action\Context;

class Reload extends \Magento\Backend\App\Action
{
    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @param Action\Context $context
     */
    public function __construct(
        Context $context
    ) {
        parent::__construct($context);
        $this->_config = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
    }

    /**
     * Save action
     *
     * @return \Magento\Framework\Controller\ResultInterface
     */
    public function execute()
    {
        $fields = $this->_objectManager->create('\Tym17\MailPerformance\Model\Fields');
        $segments = $this->_objectManager->create('\Tym17\MailPerformance\Model\Segments');
        if (!$fields->populate() || !$segments->populate())
        {
            $this->messageManager->addWarning(__('Failed reloading your MailPerformance components'));
        }
        else
        {
            $this->messageManager->addSuccess(__('Succesfully reloaded your MailPerformance components'));
        }
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/Check/Index', [ 'path' => $this->getRequest()->getParam('path')]);
    }
}
