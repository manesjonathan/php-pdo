<?php
/**** Supprimer une randonnée ****/
include_once('../../database/HikingService.php');
session_start();
if (isset($_SESSION['username']) && isset($_SESSION['password'])) {

    if (isset($_POST['delete'])) {
        $id = $_POST['hiking_id'];
        $hikingService = new HikingService();
        $hikingService->deleteHiking($id);
        header('Location: read.php');
    }
}