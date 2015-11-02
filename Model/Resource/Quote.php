<?php
namespace NP6\MailPerformance\Model\Resource;

class Quote extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('quote', NULL);
    }

    public function getSqlColumn($nameTable, $namePrimaryKey, $valuePrimaryKey, $nameColumn)
    {
        $pathQuery = $namePrimaryKey . ' = \'' . $valuePrimaryKey . '\'';
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select($nameColumn)
            ->from($nameTable)
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

    public function getSqlLine($nameTable, $namePrimaryKey, $valuePrimaryKey)
    {
        $pathQuery = $namePrimaryKey . ' = \'' . $valuePrimaryKey . '\'';
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($nameTable)
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

}
