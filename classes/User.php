<?php
require_once '../lib/Database.php';
require_once '../helpers/Format.php';

?>

<?php

Class User
{

    private $db;
    private $fm;

    function __construct()
    {
        $this->db = new Database();
        $this->fm = new Format();
    }
}


?>