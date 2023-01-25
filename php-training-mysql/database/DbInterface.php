<?php

namespace App\database;

interface DbInterface
{
    const HOST ="localhost";
    const DBNAME = "reunion_island";
    const USER ="root";
    const PASSWORD = "";
    function getConnection();
}
