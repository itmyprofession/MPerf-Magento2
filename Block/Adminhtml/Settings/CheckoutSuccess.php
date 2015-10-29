<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class CheckoutSuccess extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var string
     */
    const CFG_PATH = 'events/CheckoutSuccess/';

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
     * @param  string
     * @param  string
     * @return void
     */
    protected function addField($fieldset, $name, $label)
    {
        $fieldset->addField(
            $name,
            'select',
            [
                'label' => __($label),
                'required' => true,
                'name' => $name,
                'options' => $this->list->getFields($this->_config->getConfig(self::CFG_PATH . $name, 'none')),
                'disabled' => false
            ]
        );
    }

    /**
     * @return void
     */
    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();

        /* EventBindings Configuration */
        $fieldset = $form->addFieldset('settings_events', ['legend' => __('Checkout Success')]);

        $fieldset->addField('notif_cart_edit', 'note', ['label' => __('Called after succesful checkout'), 'text' => __('Adds the customer in a segment')]);

        $fieldset->addField(
            'segment',
            'select',
            [
                'label' => __('Segment'),
                'title' => __('Segment'),
                'required' => true,
                'name' => 'segment',
                'options' => $this->list->getSegments($this->_config->getConfig(self::CFG_PATH . 'segment', 'none')),
                'disabled' => false
            ]
        );

        $fieldset->addField('cart_edit_fields_to_modif', 'note', ['label' => '', 'text' => __('Fields to update on event.')]);

        $this->addField($fieldset, 'coupon_code', 'Coupon used');
        $this->addField($fieldset, 'store_id', 'Store Id');
        $this->addField($fieldset, 'total_due', 'Total');
        $this->addField($fieldset, 'is_virtual', 'Only virtual orders');
        $this->addField($fieldset, 'total_qty_ordered', 'Quantity of ordered items');
        $this->addField($fieldset, 'customer_is_guest', 'Is Guest');
        $this->addField($fieldset, 'coupon_rule_name', 'Coupon name');



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
            $html = substr($html, 0, -24);
            $html .= '
                    <div class="admin__field field field-notif_cart_edit ">
                        <label class="label admin__field-label"></label>
                        <div class="admin__field-control control">
                            <button class="primary" style="vertical-align:middle" type="submit">' . __('Save') . '</button>
                        </div>
                    </div>';
            $html .= '</fieldset></form>';
            $html .= '<style>.redText{ color:red!Important; }.blackText{ color:black; }.myButton{ text-align:center; }</style>';
            $html = preg_replace("#<option#", "<option class=\"blackText\"", $html);
            $html = preg_replace("#blackText(.*?)>&lt;isUnicity&gt;#", "redText$1>", $html);
            $html = preg_replace("#<select id=\"field\"#", "<select id=\"field\" onchange=\"this.className=this.options[this.selectedIndex].className\"", $html);
            return $html;
        }
        return '';
    }
}
