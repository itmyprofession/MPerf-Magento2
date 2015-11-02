<?php
namespace NP6\MailPerformance\Controller\Adminhtml\Settings;

class Save extends \Magento\Backend\App\Action
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @param  array $field
     * @param  string $key
     * @return bool
     */
    protected function checkTypeIntegrity($field, $key)
    {
        if ($field['type'] == 'singleSelectList'
            || $field['type'] == 'multipleSelectList')
        {
            return true;
        }
        return false;
    }

    /**
     * @param  array $result
     * @return array
     */
    protected function checkIntegrity($result)
    {
        /* Get fields to prepair comparison */
        $fieldsModel = $this->_objectManager->create('NP6\MailPerformance\Model\Fields');
        $fields = $fieldsModel->getAllFields();
        $unicity = 0;
        $type = 0;
        /* Check for each element valid */
        foreach ($result as $key => $elem) {
            /* Since we're checking valid fields, empty fields and segments doesn't require check */
            if ($key != 'form_key' && $key != 'segment' && $elem != 'none')
            {
                foreach ($fields as $field)
                {
                    if ($field['id'] == $elem)
                    {
                        /* Checking if corresponding field is unicity critera */
                        if ($field['isUnicity'] == 1)
                        {
                            $unicity += 1;
                        }
                        /* Check if chosen value is valid for API calls */
                        if ($this->checkTypeIntegrity($field, $key))
                        {
                            $type += 1;
                        }
                    }
                }
            }
        }
        if ($unicity != 1)
        {
            return ['haveError' => true, 'message' => __('Please select only one field with unicity.')];
        }
        else if ($type != 0)
        {
            $this->messageManager->addWarning(__('Some fields you selected may have unexpected result if they aren\'t bind correctly'));
        }
        return ['haveError' => false, 'message' => ''];
    }

    /**
     * @return bool
     */
    private function checkAndSave()
    {
        $toSave = $this->getRequest()->getPostValue();
        /* Check if settings are valid for API calls, returning an error if anything goes wrong*/
        $integrity = $this->checkIntegrity($toSave);
        /* Check if there is an error and then return it */
        if ($integrity['haveError'])
        {
            $this->messageManager->addError($integrity['message']);
            return false;
        }
        /* Since we're fine, let's save. */
        $event = $this->getRequest()->getParam('form') . '/';
        foreach ($toSave as $key => $result) {
            if ($key != 'form_key')
            {
                $this->_config->saveConfig($event . $key, $result);
            }
        }
        $this->messageManager->addSuccess(__('Saved !'));
        return true;
    }

    /**
     * @return mixed
     */
    public function execute()
    {
        $this->_config = $this->_objectManager->create('NP6\MailPerformance\Model\Config');
        $this->checkAndSave();
        /* Since we're only sending a message to tell if save attempt went fine or not */
        $resultRedirect = $this->resultRedirectFactory->create();
        return $resultRedirect->setPath('*/Settings');
    }
}
