<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Customer extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected $_config;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Data\FormFactory $formFactory
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\Registry $registry,
        \Magento\Framework\Data\FormFactory $formFactory,
        Helper\ConfigHelper $config,
        array $data = []
    ) {
        $this->_config = $config;
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return bool
     */
    public function isReady()
    {
        return $this->_config->isReady();
    }

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();

        /* Customer Management Configuration */
        $fieldset = $form->addFieldset('settings_customers', ['legend' => __('Customer Management')]);

        $fieldset->addField('sample', 'note', ['label' => __('setnaem'), 'text' => 'saample']);

        /* form finalisation */
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('customer');
        $form->setAction($this->getUrl('testurl'));

        $this->setForm($form);
    }
}
