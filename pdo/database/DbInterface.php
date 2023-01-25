<?php

namespace database;
interface DbInterface
{
    const HOST = "localhost";
    const DBNAME = "weatherapp";
    const USER = "root";
    const PASSWORD = "";

    function get_connection();
}
