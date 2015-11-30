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
        \Magento\Framework\Model\ResourceModel\AbstractResource $resource = null,
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
     * @param string
     * @param string
     * @param string
     * @return array
     */
    private function getSqlColumn($nameTable, $namePrimaryKey, $valuePrimaryKey, $nameColumn)
    {
        $Column = $this->_getResource()->getSqlColumn($nameTable, $namePrimaryKey, $valuePrimaryKey, $nameColumn);
        return ($Column);
    }

    /**
     * @param string
     * @param string
     * @param string
     * @return array
     */
    private function getSqlLine($nameTable, $namePrimaryKey, $valuePrimaryKey)
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
                if ($value[0] == "")
                {
                    $value[0] = "none";
                }
            }
            else if ($field['type'] == 'singleSelectList')
            {
                if ($value == "")
                {
                    $value = "none";
                }
            }
        }
    }

    /**
     * @param  int $adressId
     * @return array
     */
    protected function getGuestName($adressId)
    {
        $result = $this->getSqlLine('sales_order_address', 'entity_id', $adressId);
        $guestName = ['firstname' => $result[0]['firstname'], 'lastname' => $result[0]['lastname']];
        return $guestName;
    }

    /**
     * @param  string
     * @return array
     */
    public function getOrderData($valuePrimaryKey)
    {
        $tabFromSql = $this->getSqlLine('sales_order', 'entity_id', $valuePrimaryKey);

        /* Data that needs to be harvested */
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
            'customer_group_id'
        );

        /* Future json to be sent */
        $tabToFields = [];

        /* Get customer name if he is a guest */
        if ($tabFromSql[0]['customer_is_guest'] == 1)
        {
            $guestInfos = $this->getGuestName($tabFromSql[0]['billing_address_id']);
            $tabFromSql[0]['customer_firstname'] = $guestInfos['firstname'];
            $tabFromSql[0]['customer_lastname'] = $guestInfos['lastname'];
        }

        /* Retrieve chosen fields IDs */
        foreach ($nameTab as $key)
        {
            $fieldId = $this->cfg->getConfig('checkoutSuccess/' . $key, 'none');
            if ($fieldId != 'none')
            {
                $tabToFields[$fieldId] = $tabFromSql[0][$key];
            }
        }

        /* Put fields in right format acording field type */
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
