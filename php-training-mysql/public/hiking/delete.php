<?php
/**** Supprimer une randonnée ****/
include_once('../../database/HikingService.php');

if (isset($_POST['delete'])) {
    $id = $_POST['hiking_id'];
    $hikingService = new HikingService();
    $hikingService->deleteHiking($id);
    header('Location: read.php');
}