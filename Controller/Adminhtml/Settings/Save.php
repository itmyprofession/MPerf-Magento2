<?php
namespace Tym17\MailPerformance\Controller\Adminhtml\Settings;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @return mixed
     */
    public function execute()
    {
        $this->_config = $this->_objectManager->create('Tym17\MailPerformance\Model\Config');
        $toSave = $this->getRequest()->getPostValue();
        $event = $this->getRequest()->getParam('form') . '/';
        foreach ($toSave as $key => $result) {
            if ($key != 'form_key')
            {
                $this->_config->saveConfig($event . $key, $result);
            }
        }
        $this->messageManager->addSuccess(__('Saved !'));
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/Settings');
    }
}
