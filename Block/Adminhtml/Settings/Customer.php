<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Customer extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \Tym17\MailPerformance\Model\Config
     */
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
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        $this->_config = $objectManager->create('Tym17\MailPerformance\Model\Config');
        parent::__construct($context, $registry, $formFactory, $data);
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
        $form->setAction($this->getUrl('*/*/Save/Customer'));

        $this->setForm($form);
    }

    /**
     * @return string
     */
    public function getFormHtml()
    {
        if (is_object($this->getForm()))
        {
            $html = $this->getForm()->getHtml();
            $html = substr($html, 0, -7);
            $html .= '<button class="primary" type="submit">' . __('Save') . '</button>';
            $html .= '</form>';
            return $html;
        }
        return '';
    }
}
