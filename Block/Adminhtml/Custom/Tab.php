<?php
namespace Tym17\MailPerformance\Block\Adminhtml\Custom;

use Magento\Backend\Block\Template;

class Tab extends Template
{
    /**
     * @var string
     */
    public $navTitle = null;

    /**
     * @var array
     */
    public $tabName;

    /**
     * @var array
     */
    public $tabContent;

    /**
     * @var integer
     */
    public $tabAmmount = 0;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
    }

    public function getTabId()
    {
        return $this->_nameInLayout;
    }

    /**
     * @param string
     */
    public function setNavTitle($title)
    {
        $this->navTitle = $title;
    }

    /**
     * @param string
     * @param string
     */
    public function addTab($name, $content)
    {
        $this->tabName[] = array('name' => $name, 'content' => $content);
        $this->tabContent[] = $content;
        $this->tabAmmount += 1;
    }
}
