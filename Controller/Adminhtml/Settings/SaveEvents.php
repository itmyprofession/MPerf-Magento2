<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

class SaveEvents extends \Magento\Backend\App\Action
{
    /**
     * @var string
     */
    const CFG_PATH = 'events/';

    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @return mixed
     */
    public function execute()
    {
        $this->messageManager->addSuccess(__('Saved !'));
        $this->_config = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
        $toSave = $this->getRequest()->getPostValue();
        $this->_config->saveConfig(self::CFG_PATH . 'cartEdit/segment', $toSave['segment']);
        $this->_config->saveConfig(self::CFG_PATH . 'cartEdit/field', $toSave['field']);
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/Settings');
    }
}
