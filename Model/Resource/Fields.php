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
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(id)"));

        $result = $readAdapter->fetchAll($select);
        $data['id'] = $result[0]['MAX(id)'] + 1;

        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->insertForce($this->getMainTable(), $data);
    }

    /**
     * @param  string $path
     * @return array $result
     */
    public function getFields($path)
    {
        $pathQuery = 'path = \'' . $path . '\'';
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable())
            ->where($pathQuery);
        $result = $readAdapter->fetchAll($select);
        return $result;
    }

    /**
     * @param  string $id
     * @param  string $name
     * @return void
     */
    public function saveFields($id, $name)
    {
        $data = ['path' => $id, 'value' => $name];
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
