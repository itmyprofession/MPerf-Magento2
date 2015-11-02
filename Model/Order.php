<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model;

class Order extends \Magento\Framework\Model\AbstractModel
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    protected $cfg;

    /**
     * @var \NP6\MailPerformance\Model\Fields
     */
    protected $fields;

    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('NP6\MailPerformance\Model\Resource\Order');
    }

    /**
     * @param  \Magento\Framework\Model\Context $context
     * @param  \Magento\Framework\Registry $registry
     * @param  \NP6\MailPerformance\Helper\RestHelper $rest
     *  @param  \Magento\Framework\Model\Resource\AbstractResource $resource = null
     * @param  \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null
     * @param  array $data = []
     * @return void
     */
    public function __construct(
        \Magento\Framework\Model\Context $context,
        \Magento\Framework\Registry $registry,
        \NP6\MailPerformance\Model\Config $cfg,
        \NP6\MailPerformance\Model\Fields $fields,
        \Magento\Framework\Model\Resource\AbstractResource $resource = null,
        \Magento\Framework\Data\Collection\AbstractDb $resourceCollection = null,
        array $data = []
    ) {
        $this->cfg = $cfg;
        $this->fields = $fields;
        parent::__construct(
            $context,
            $registry,
            $resource,
            $resourceCollection,
            $data
        );
    }

    /**
     * @param string
     * @return array
     */
    public function getSqlColumn($nameTable, $namePrimaryKey, $valuePrimaryKey, $nameColumn)
    {
        $Column = $this->_getResource()->getSqlColumn($nameTable, $namePrimaryKey, $valuePrimaryKey, $nameColumn);

        return ($Column);
    }

    /**
     * @param string
     * @return array
     */
    public function getSqlLine($nameTable, $namePrimaryKey, $valuePrimaryKey)
    {
        $Line = $this->_getResource()->getSqlLine($nameTable, $namePrimaryKey, $valuePrimaryKey);

        return ($Line);
    }

    /**
     * @param  array $field
     * @param  string $key
     * @param  mixed $value
     * @return void
     */
    protected function reformat($field, $key, &$value)
    {
        /* Check corresponding field */
        if ($field['id'] == $key)
        {
            /* if field is a special type, make it compatible with the API call */
            if ($field['type'] == 'numeric')
            {
                /* Tricky cast working with floats and ints */
                $value = 0 + $value;
            }
            else if ($field['type'] == 'multipleSelectList')
            {
                $value = explode(',', $value);
            }
        }
    }

    /**
     * @param  string
     * @return array
     */
    public function getDataFromSqlToFields($valuePrimaryKey)
    {
        $tabFromSql = $this->getSqlLine('sales_order', 'entity_id', $valuePrimaryKey);

        $nameTab = array(
            'coupon_code',
            'store_id',
            'total_due',
            'is_virtual',
            'total_qty_ordered',
            'customer_is_guest',
            'coupon_rule_name',
            'created_at',
            'updated_at',
            'order_currency_code',
            'shipping_method',
            'customer_firstname',
            'customer_lastname',
            'customer_email',
            'weight',
            'shipping_address_id',
            'customer_group_id');

        $tabToFields = array();

        /* Retrieve chosen fields IDs */
        foreach ($nameTab as $key)
        {
            $fieldId = $this->cfg->getConfig('checkoutSuccess/' . $key, 'none');
            if ($fieldId != 'none')
            {
                $tabToFields[$fieldId] = $tabFromSql[0][$key];
            }
        }

        /* Put fields in right formart */
        $fieldTab = $this->fields->getAllFields();
        foreach ($fieldTab as $field)
        {
            foreach ($tabToFields as $key => &$value)
            {
                $this->reformat($field, $key, $value);
            }
        }
        return ($tabToFields);
    }
}
