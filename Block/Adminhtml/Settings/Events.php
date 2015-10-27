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
     * @var \Tym17\MailPerformance\Model\System\ApiList
     */
    protected $list;

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
        \Tym17\MailPerformance\Model\System\ApiList $list,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->list = $list;
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
            'segment',
            'select',
            [
                'label' => __('Segment'),
                'title' => __('Segment'),
                'required' => true,
                'name' => 'segment',
                'options' => $this->list->getSegments(),
                'disabled' => false
            ]
        );

        $fieldset->addField(
            'field',
            'select',
            [
                'label' => __('Field'),
                'title' => __('Field'),
                'required' => true,
                'name' => 'field',
                'options' => $this->list->getFields(),
                'disabled' => false
            ]
        );

        /* form finalisation */
        $form->setMethod('post');
            $form->setUseContainer(true);
        $form->setId('events');
        $form->setAction($this->getUrl('*/*/SaveEvents'));

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
            $html .= '<button class="primary" style="vertical-align:middle" type="submit">' . __('Save') . '</button>';
            $html .= '</form>';
            $html .= '<style>.redText{ color:red!Important; }.blackText{ color:black; }</style>';
            $html = preg_replace("#<option#", "<option class=\"blackText\"", $html);
            $html = preg_replace("#blackText(.*?)>&lt;isUnicity&gt;#", "redText$1>", $html);
            $html = preg_replace("#<select id=\"field\"#", "<select id=\"field\" onchange=\"this.className=this.options[this.selectedIndex].className\"", $html);
            echo htmlspecialchars($html);
            return $html;
        }
        return '';
    }
}
