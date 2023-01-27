<?php

namespace App\database;

interface DbInterface
{
    const HOST ="localhost";
    const DBNAME = "becode";
    const USER ="root";
    const PASSWORD = "";
    function getConnection();
}
