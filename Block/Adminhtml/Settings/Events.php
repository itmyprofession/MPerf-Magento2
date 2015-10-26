<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Events extends \Magento\Backend\Block\Widget\Form\Generic
{
    protected $_systemStore;

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
        \Magento\Store\Model\System\Store $systemStore,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->_config = $objectManager->create('Tym17\MailPerformance\Model\Config');
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @return void
     */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();

        /* EventBindings Configuration */
        $fieldset = $form->addFieldset('settings_events', ['legend' => __('Event Binding')]);

        $fieldset->addField('notif_cart_edit', 'note', ['label' => __('Called after cart creation/edition'), 'text' => __('Adds the customer in a segment')]);

        $fieldset->addField(
            'select_stores',
            'multiselect',
            [
                'label' => __('Visibility'),
                'required' => true,
                'name' => 'select_stores[]',
                'values' => $this->_systemStore->getStoreValuesForForm()
            ]
        );

        /* form finalisation */
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('events');
        $form->setAction($this->getUrl('*/*/Save'));

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
