<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Settings;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Cart extends \Magento\Backend\Block\Widget\Form\Generic
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

        /* Cart Abandonment Configuration */
        $fieldset = $form->addFieldset('settings_cart', ['legend' => __('Cart Abandonment')]);

        $fieldset->addField('samplee', 'note', ['label' => __('setnaem'), 'text' => 'saamople']);

        /* form finalisation */
        $form->setMethod('post');
        $form->setUseContainer(true);
        $form->setId('cart');
        $form->setAction($this->getUrl('testurl'));

        $this->setForm($form);
    }
}
