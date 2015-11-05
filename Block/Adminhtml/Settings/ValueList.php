<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use NP6\MailPerformance\Helper;

class ValueList extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var string
     */
    const NAME = 'ValueList';
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $_config;

    /**
     * @var \NP6\MailPerformance\Model\System\ConfList
     */
    protected $list;

    /**
     * @var \NP6\MailPerformance\Model\System\ApiList
     */
    protected $apiList;

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
        \NP6\MailPerformance\Model\System\ConfList $list,
        array $data = []
    ) {
        $this->list = $list;
        $this->apiList = $objectManager->create('NP6\MailPerformance\Model\System\ApiList');
        $this->_config = $objectManager->create('NP6\MailPerformance\Model\Config');
        parent::__construct($context, $registry, $formFactory, $data);
    }

    /**
     * @param  string
     * @param  string
     * @return void
     */
    protected function addField($fieldset, $name, $label, $options, $isRequired = false)
    {
        $fieldset->addField(
            $name,
            'select',
            [
                'label' => __($label),
                'required' => $isRequired,
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

        $fieldset = $form->addFieldset('settings_valuelist', ['legend' => __('List of values')]);

        $fieldset->addField('notif_cart_edit', 'note', ['label' => '', 'text' => __('Create or populate a list of value field')]);

        $this->addField($fieldset, 'populate',
            'Add new values to the list if value doesn\'t exists ?',
            $this->list->getYesNo(self::NAME . '/populate'));

        $fieldset->addField('valuelabel', 'note', ['label' => '', 'text' => __('Choose in wich list to generate values')]);

        $this->addField($fieldset, 'shipping', 'Shipping', $this->apiList->getList(self::NAME . '/shipping'));

        $fieldset->addField(
            $
        )

        /* form finalisation */
        $form->setMethod('post');
            $form->setUseContainer(true);
        $form->setId(self::NAME);
        $form->setAction($this->getUrl('*/*/Dump', ['form' => self::NAME]));

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
                        <button class="primary" style="vertical-align:middle" type="submit" name="button" value="save">' . __('Save') . '</button>
                        <button  style="vertical-align:middle" type="submit" name="button" value="generate">' . __('Save') . __(' and Generate lists') . '</button>
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
