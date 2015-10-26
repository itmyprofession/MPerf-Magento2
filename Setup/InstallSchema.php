<?php

namespace Tym17\MailPerformance\Setup;

use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\SchemaSetupInterface;

/**
 * @codeCoverageIgnore
 */
class InstallSchema implements InstallSchemaInterface
{
    /**
     * {@inheritdoc}
     * @SuppressWarnings(PHPMD.ExcessiveMethodLength)
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $installer = $setup;

        $installer->startSetup();

        /**
        * Create table 'mailperf_config'
        */
        $table_config = $installer->getConnection()->newTable(
            $installer->getTable('mailperf_config')
        )->addColumn(
            'config_id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true, 'nullable' => false, 'primary' => true),
            'Config Id'
        )->addColumn(
            'path',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'Config Path'
        )->addColumn(
            'value',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => true),
            'Config Value'
        )->setComment(
        'MailPerformance Config Table'
        );
        $installer->getConnection()->createTable($table_config);

        /**
        * Create table 'mailperf_fields'
        */
        $table_fields = $installer->getConnection()->newTable(
            $installer->getTable('mailperf_fields')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('nullable' => false, 'primary' => true),
            'Fields Id'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'Fields Name'
        )->addColumn(
            'isUnicity',
            \Magento\Framework\DB\Ddl\Table::TYPE_BOOLEAN,
            null,
            array('nullable' => false),
            'Fields Unicity'
        )->setComment(
        'MailPerformance Fields Table'
        );
        $installer->getConnection()->createTable($table_fields);

        /**
        * Create table 'mailperf_segments'
        */
        $table_segments = $installer->getConnection()->newTable(
            $installer->getTable('mailperf_segments')
        )->addColumn(
            'id',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('nullable' => false, 'primary' => true),
            'Segments Id'
        )->addColumn(
            'name',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            255,
            array('nullable' => false),
            'Segments Name'
        )->setComment(
        'MailPerformance Segments Table'
        );
        $installer->getConnection()->createTable($table_segments);

        $installer->endSetup();

    }
}
