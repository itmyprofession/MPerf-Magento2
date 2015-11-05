<?php
/**
 * Copyright © 2015 NP6. All rights reserved.
 * See LICENSE.txt for license details.
 */
namespace NP6\MailPerformance\Model\System;

class ConfList
{
    /**
     * @var \NP6\MailPerformance\Model\Config
     */
    private $cfg;

    /**
     * @param  \NP6\MailPerformance\Model\Segments $segments
     * @param  \NP6\MailPerformance\Model\Fields $fields
     * @return void
     */
    public function __construct(
        \NP6\MailPerformance\Model\Config $cfg
    ) {
        $this->cfg = $cfg;
    }

    /**
     * @param  string $path
     * @return array
     */
    public function getYesNo($path, $def = 'No')
    {
        $list = [];
        if ($this->cfg->getConfig($path, $def) == 'Yes')
        {
            $list['true'] = 'Yes';
            $list['false'] = 'No';
        }
        else
        {
            $list['false'] = 'No';
            $list['true'] = 'Yes';
        }
        return $list;
    }
}
