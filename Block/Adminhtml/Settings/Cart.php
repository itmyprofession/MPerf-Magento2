<?php
namespace NP6\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use NP6\MailPerformance\Helper;

class Cart extends \Magento\Backend\Block\Widget\Form\Generic
{
    /**
     * @var \NP6\MailPerformance\Model\Config
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
        $this->_config = $objectManager->create('NP6\MailPerformance\Model\Config');
        parent::__construct($context, $registry, $formFactory, $data);
    }

    protected function _prepareForm()
    {
        $form = $this->_formFactory->create();

        /* Cart Abandonment Configuration */
        $fieldset = $form->addFieldset('settings_cart', ['legend' => __('Cart Abandonment')]);

        $fieldset->addField('samplee', 'note', ['label' => __('setnaem'), 'text' => 'saamople']);

        /* form finalisation */
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('cart');
        $form->setAction($this->getUrl('*/*/SaveCart'));

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
            $html .= '<style>.redText{ color:red!Important; }.blackText{ color:black; }</style>';
            $html = preg_replace("#<option#", "<option class=\"blackText\"", $html);
            $html = preg_replace("#blackText(.*?)>&lt;isUnicity&gt;#", "redText$1>", $html);
            $html = preg_replace("#<select id=\"field\"#", "<select id=\"field\" onchange=\"this.className=this.options[this.selectedIndex].className\"", $html);
            return $html;
        }
        return '';
    }
}
