<?php
namespace Tym17\MailPerformance\Model\ApiConnector;

use Magento\Framework;
use Tym17\MailPerformance\Helper;

class AbstractConnector extends Framework\Model\AbstractModel
{
    /**
     * @var Tym17\MailPerformance\Helper\ConfigHelper
     */
    protected $_configHelper;

    /**
     * @var Tym17\MailPerformance\Helper\RestHelper
     */
    protected $_restHelper;

    /**
     * @var string
     */
    protected $_apiPath;

    /**
     * @param \Magento\Framework\Model\Context $context
     * @param \Magento\Framework\Registry $registry
     * @param \Magento\Framework\Model\Resource\AbstractResource $resource
     * @param \Magento\Framework\Data\Collection\Db $resourceCollection
     * @param array $data
     */
    public function __construct(
        Framework\Model\Context $context,
        Framework\Registry $registry,
        Framework\Model\Resource\AbstractResource $resource = null,
        Framework\Data\Collection\Db $resourceCollection = null,
        Helper\RestHelper $rest,
        Helper\ConfigHelper $config,
        array $data = array()
    ) {
        $this->_configHelper = $config;
        $this->_restHelper = $rest;
        parent::__construct($context, $registry, $resource, $resourceCollection, $data);
    }
}
