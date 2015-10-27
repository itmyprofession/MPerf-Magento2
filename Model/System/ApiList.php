<?php
namespace Tym17\MailPerformance\Model\System;

class ApiList
{
    /**
     * @var \Tym17\MailPerformance\Model\Segments
     */
    private $segments;

    /**
     * @var \Tym17\MailPerformance\Model\fields
     */
    private $fields;

    /**
     * @param  \Tym17\MailPerformance\Model\Segments $segments
     * @param  \Tym17\MailPerformance\Model\Fields $fields
     * @return void
     */
    public function __construct(
        \Tym17\MailPerformance\Model\Segments $segments,
        \Tym17\MailPerformance\Model\Fields $fields
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
        $segTab[] = ['id' => 'none', 'name' => __('Don\'t bind')];
        $specialKey = array_search($special, array_column($segTab, 'id'));
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
        $fieldTab[] = ['id' => 'none', 'name' => __('Don\'t bind'), 'isUnicity' => 0];
        $specialKey = array_search($special, array_column($fieldTab, 'id'));
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
