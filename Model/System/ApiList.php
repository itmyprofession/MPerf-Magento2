<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\System;

class ApiList
{
    /**
     * @var \NP6\MailPerformance\Model\Segments
     */
    private $segments;

    /**
     * @var \NP6\MailPerformance\Model\fields
     */
    private $fields;

    /**
     * @param  \NP6\MailPerformance\Model\Segments $segments
     * @param  \NP6\MailPerformance\Model\Fields $fields
     * @return void
     */
    public function __construct(
        \NP6\MailPerformance\Model\Segments $segments,
        \NP6\MailPerformance\Model\Fields $fields
    ) {
        $this->segments = $segments;
        $this->fields = $fields;
    }

    /**
     * @return array
     */
    public function getSegments($special = 'none')
    {
        $result = [];
        $segTab = $this->segments->getAllSegments();
        /* We add empty item */
        $segTab[] = ['id' => 'none', 'name' => __('Don\'t bind')];
        /* We get the item index we need to put first in the list */
        $specialKey = array_search($special, array_column($segTab, 'id'));
        /* We put the item as first in the list */
        $result[$special] = $segTab[$specialKey]['name'];
        foreach ($segTab as $segment)
        {
            if ($segment['id'] != $special)
            {
                $result[$segment['id']] = $segment['name'];
            }
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getFields($special = 'none')
    {
        $result = [];
        $fieldTab = $this->fields->getAllFields();
        /* We add empty item */
        $fieldTab[] = ['id' => 'none', 'name' => __('Don\'t bind'), 'isUnicity' => 0];
        /* We get the item index we need to put first in the list */
        $specialKey = array_search($special, array_column($fieldTab, 'id'));
        /* We put the item as first in the list */
        $result[$special] = $fieldTab[$specialKey]['name'];
        foreach ($fieldTab as $field)
        {
            if ($field['id'] != $special)
            {
                $txt = $field['name'];
                if ($field['isUnicity'] == 1)
                {
                    $txt = '<isUnicity>' . $txt . ' (Unicity)';
                }
                $result[$field['id']] = $txt;
            }
            else if ($field['isUnicity'] == 1)
            {
                $result[$field['id']] = '<isUnicity>' . $result[$field['id']] . ' (Unicity)';
            }
        }
        return $result;
    }
}
