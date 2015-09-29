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
        * Create table 'mailperf_targets'
        */
        $table = $installer->getConnection()->newTable(
            $installer->getTable('mailperf_targets')
        )->addColumn(
            'id_magento',
            \Magento\Framework\DB\Ddl\Table::TYPE_INTEGER,
            null,
            array('identity' => true, 'nullable' => false, 'primary' => true),
            'magento ID'
        )->addColumn(
            'id_mailperf',
            \Magento\Framework\DB\Ddl\Table::TYPE_TEXT,
            8,
            array('nullable' => false),
            'mperf id'
        )->setComment(
        'MailPerformance Table'
        );
        $installer->getConnection()->createTable($table);

        $installer->endSetup();

    }
}
