<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use NP6\MailPerformance\Helper;

class CheckoutSuccess extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var string
     */
    const NAME = 'checkoutSuccess';
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @var \NP6\MailPerformance\Model\System\ApiList
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
        \NP6\MailPerformance\Model\System\ApiList $list,
        array $data = []
    ) {
        $this->_systemStore = $systemStore;
        $this->list = $list;
        $this->_config = $objectManager->create('NP6\MailPerformance\Model\Config');
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @param  string
     * @param  string
     * @return void
     */
    protected function addField($fieldset, $name, $label, $isField = true)
    {
        if ($isField)
        {
            $options = $this->list->getFields($this->_config->getConfig(self::NAME . '/' . $name, 'none'));
        }
        else
        {
            $options = $this->list->getSegments($this->_config->getConfig(self::NAME . '/' . $name, 'none'));
        }
        $fieldset->addField(
            $name,
            'select',
            [
                'label' => __($label),
                'required' => true,
                'name' => $name,
                'options' => $options,
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

        $fieldset->addField('notif_cart_edit', 'note', ['label' => __('Called after successful checkout'), 'text' => __('Adds the customer in a segment')]);

        $this->addField($fieldset, 'segment', 'Segment', false);


        $fieldset->addField('cart_edit_fields_to_modif', 'note', ['label' => '', 'text' => __('Fields to update on event.')]);

        $this->addField($fieldset, 'store_id', 'Store Id');
        $this->addField($fieldset, 'total_due', 'Total');
        $this->addField($fieldset, 'is_virtual', 'Only virtual orders');
        $this->addField($fieldset, 'total_qty_ordered', 'Quantity of ordered items');
        $this->addField($fieldset, 'customer_is_guest', 'Is Guest');
        $this->addField($fieldset, 'created_at', 'Creation date');
        $this->addField($fieldset, 'order_currency_code', 'Currency');
        $this->addField($fieldset, 'shipping_method', 'Shipping method');
        $this->addField($fieldset, 'customer_firstname', 'Customer\'s first name');
        $this->addField($fieldset, 'customer_lastname', 'Customer\'s last name');
        $this->addField($fieldset, 'customer_email', 'Customer\'s email');
        $this->addField($fieldset, 'weight', 'Weight');
        $this->addField($fieldset, 'shipping_address_id', 'Shipping adress Id');
        $this->addField($fieldset, 'customer_group_id', 'Customer Group Id');

        /* form finalisation */
        $form->setMethod('post');
            $form->setUseContainer(true);
        $form->setId(self::NAME);
        $form->setAction($this->getUrl('*/*/Save', ['form' => self::NAME]));

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
            $html .= '
                <style>
                    .redText{ color:red!Important; }
                    .blackText{ color:black; }
                    .myButton{ text-align:center; }
                    .admin__scope-old .fieldset .field { margin: 0px 0px 29px!Important; }
                </style>';
            $html = preg_replace("#<option#", "<option class=\"blackText\"", $html);
            $html = preg_replace("#blackText(.*?)>&lt;isUnicity&gt;#", "redText$1>", $html);
            $html = preg_replace("#<select id=\"field\"#", "<select id=\"field\" onchange=\"this.className=this.options[this.selectedIndex].className\"", $html);
            return $html;
        }
        return '';
    }
}
