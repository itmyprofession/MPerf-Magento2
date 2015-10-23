<?php
namespace Tym17\MailPerformance\Model\Resource;

class Segments extends \Magento\Framework\Model\Resource\Db\AbstractDb
{
    /**
     * @return void
     */
    protected function _construct()
    {
        $this->_init('mailperf_segments', 'id');
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _updateSegments($data)
    {
        $nameQuery = 'id = \'' . $data['id'] . '\'';

        /*
        **   Connect to Db then update Segments
        **   ->getConnection() in Magento2/dev branch
        */
        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->update($this->getMainTable(), $data, $nameQuery);
    }

    /**
     * @param  array $data
     * @return void
     */
    protected function _createSegments($data)
    {
        $readAdapter =$this->_getReadAdapter();
        $select = $readAdapter->select()
            ->from($this->getMainTable(),
            new \Zend_Db_Expr("MAX(id)"));

        $result = $readAdapter->fetchAll($select);

        $writeAdapter = $this->_getWriteAdapter();
        $writeAdapter->insertForce($this->getMainTable(), $data);
    }

    /**
     * @param  string $path
     * @return array $result
     */
    public function getSegments($id)
    {
        $pathQuery = 'id = \'' . $id . '\'';
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
    public function saveSegments($id, $name)
    {
        $data = ['id' => $id, 'name' => $name];
        if (!empty($this->getSegments($id)))
        {
            $this->_updateSegments($data);
        }
        else
        {
            $this->_createSegments($data);
        }
    }
}
