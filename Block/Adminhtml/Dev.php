<?php
namespace Tym17\MailPerformance\Block\Adminhtml;

use Magento\Backend\Block\Template;
use Tym17\MailPerformance\Helper;

class Dev extends Template
{
    /**
     * @var \Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var \Tym17\MailPerformance\Model\Fields
     */
    protected $_fields;

    /**
     * @var \Tym17\MailPerformance\Model\Segments
     */
    protected $_segments;

    /**
     * @var \Tym17\MailPerformance\Model\quote
     */
    protected $_quote;

    /**
     * @var \Magento\Framework\ObjectManagerInterface
     */
    protected $_objectManager;

    /**
    * @param Context $context
    * @param array $data
    */
    public function __construct(
        Template\Context $context,
        Helper\RestHelper $rest,
        \Magento\Framework\ObjectManagerInterface $objectManager,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->_fields = $objectManager->create('\Tym17\MailPerformance\Model\Fields');
        $this->_segments = $objectManager->create('\Tym17\MailPerformance\Model\Segments');
        $this->_quote = $objectManager->create('\Tym17\MailPerformance\Model\Quote');
        $this->_restHelper = $rest;
        $this->_objectManager = $objectManager;
    }

    /**
    * @return array
    */
    public function dostuff($id, $name)
    {
      $this->_fields->saveFields($id, $name);
      return 'dostuff';
    }

    /**
    * @param string
    * @return array
    */
    public function get($endUrl)
    {
      return ($this->_restHelper->get($endUrl, 1));
    }

    /**
    * @param string
    * @param array
    * @return array
    */
    public function post($endUrl, $data)
    {
      return ($this->_restHelper->post($endUrl, $data, 1));
    }

    /**
    * @param string
    * @param array
    * @return array
    */
    public function put($endUrl, $data)
    {
      return ($this->_restHelper->put($endUrl, $data, 1));
    }


    /**
    * @param string
    * @param string
    * @param string
    * @return array
    */
    public function addChangeFields($id, $name, $unicity)
    {
      $this->_fields->saveFields($id, $name, $unicity);
    }

    /**
    * @return array
    */
    public function getAllFields()
    {
         return ($this->_fields->getAllFields());
    }

    /**
    * @param string
    * @return string
    */
    public function getFields($id)
    {
         return ($this->_fields->getFields($id, '404'));
    }

    /**
    * @return void
    */
    public function flushFields()
    {
        $this->_fields->flushFields();
    }


    /**
    * @param string
    * @param string
    */
    public function addChangeSegments($id, $name)
    {
        $this->_segments->saveSegments($id, $name);
    }

    /**
    * @param string
    * @return string
    */
    public function getSegments($id)
    {
        return ($this->_segments->getSegments($id, '404'));
    }

    /**
    * @param string
    * @return string
    */
    public function getAllSegments()
    {
         return ($this->_segments->getAllSegments());
    }

    /**
    * @return void
    */
    public function flushSegments()
    {
        $this->_segments->flushSegments();
    }

    /**
    * @param string
    * @return string
    */
    public function getDataFromSqlToFields($valuePrimaryKey)
    {
        return ($this->_quote->getDataFromSqlToFields($valuePrimaryKey));
    }

}
