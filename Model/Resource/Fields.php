<?php
namespace Tym17\MailPerformance\Model\Resource;

class Fields extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_fields', 'id');
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _updateFields($data)
    {
        $nameQuery = 'id = \'' . $data['id'] . '\'';

        /*
        **   Connect to Db then update Fields
        **   ->getConnection() in Magento2/dev branch
        */
        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->update($this->getMainTable(), $data, $nameQuery);
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _createFields($data)
    {
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(id)"));

        $result = $readAdapter->fetchAll($select);

        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->insertForce($this->getMainTable(), $data);
    }

    /**
     * @return array
     */
    public function getAllFields()
    {
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable());
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

    /**
     * @param  string $path
     * @return array $result
     */
    public function getFields($id)
    {
        $pathQuery = 'id = \'' . $id . '\'';
        $readAdapter = $this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable())
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return ($result);
    }

    /**
     * @param  string $id
     * @param  string $name
     * @return void
     */
    public function saveFields($id, $name, $unicity)
    {
        $data = ['id' => $id, 'name' => $name, 'isUnicity' => $unicity];
        if (!empty($this->getFields($id)))
        {
            $this->_updateFields($data);
        }
        else
        {
            $this->_createFields($data);
        }
    }
}
