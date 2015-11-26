<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model;

class Segments extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \NP6\MailPerformance\Helper\RestHelper
     */
    protected $_rest;

    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $cfg;

    /**
    * @param  \Magento\Framework\Model\Context $context
    * @param  \Magento\Framework\Registry $registry
    * @param  \NP6\MailPerformance\Helper\RestHelper $rest
    * @param  \Magento\Framework\Model\Resource\AbstractResource $resource = null
    * @param  \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
    * @param  array $data = []
    * @return void
    */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \NP6\MailPerformance\Helper\RestHelper $rest,
        \NP6\MailPerformance\Model\Config $cfg,
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->_rest = $rest;
        $this->cfg = $cfg;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NP6\MailPerformance\Model\Resource\Segments');
    }

    /**
     * @return bool
     */
    public function populateSegments()
    {
        $this->_getResource()->createTableSegments();

        $this->_getResource()->flushSegments();
        /* Make REST request */
        $result = $this->_rest->get('segments/');

        /* Check if everything went fine or lock down the module*/
        if ($result['info']['http_code'] < 200 || $result['info']['http_code'] > 299)
        {
            $this->cfg->saveConfig('linkstate', 'unvalid');
            return false;
        }

        /* Populate DB */
        $tab = $result['result'];
        foreach ($tab as $elem)
        {
            if ($elem['type'] == 'static')
            {
                $this->saveSegments($elem['id'], $elem['name']);
            }
        }
        return true;
    }

    /**
     * @return array
     */
    public function getAllSegments()
    {
        return ($this->_getResource()->getAllSegments());
    }

    /**
     * @param  string $path
     * @return string $value
     */
    public function getSegments($path, $default)
    {
        if ($this->isSegments($path))
        {
            $result = $this->_getResource()->getSegments($path);
            return $result[0];
        }
        else
        {
            return $default;
        }
    }

    /**
     * @param  string $path
     * @return bool
     */
    public function isSegments($path)
    {
        return !empty($this->_getResource()->getSegments($path));
    }

    /**
     * @param  string $path
     * @param  string $value
     * @return void
     */
    public function saveSegments($id, $name)
    {
        $this->_getResource()->saveSegments($id, $name);
    }

    /**
     * @return void
     */
    public function flushSegments()
    {
        $this->_getResource()->flushSegments();
    }

}
