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
    public function getSegments()
    {
        $result = [];
        $segTab = $this->segments->getAllSegments();
        foreach ($segTab as $segment)
        {
            $result[$segment['id']] = $segment['name'];
        }
        return $result;
    }

    /**
     * @return array
     */
    public function getFields()
    {
        $result = [];
        $fieldTab = $this->fields->getAllFields();
        foreach ($fieldTab as $field)
        {
            $txt = $field['name'];
            if ($field['isUnicity'] == 1)
            {
                $txt = '<isUnicity>' . $txt;
            }
            $result[$field['id']] = $txt;
        }
        return $result;
    }
}
