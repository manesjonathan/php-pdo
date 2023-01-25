<?php

use model\Hiking;

require_once 'HikingDAO.php';

class HikingService
{
    private $dao;

    public function __construct()
    {
        $this->dao = new HikingDAO();
    }

    public function createHiking(Hiking $hiking)
    {
        $this->dao->create($hiking);
    }

    public function readHikes()
    {
        return $this->dao->read();
    }

    public function updateHiking(Hiking $hiking)
    {
       
        $this->dao->update($hiking);
    }

    public function deleteHiking($id)
    {
        $this->dao->delete($id);
    }


    public function getHikingById($id)
    {
        return $this->dao->getByID($id);
    }
}
