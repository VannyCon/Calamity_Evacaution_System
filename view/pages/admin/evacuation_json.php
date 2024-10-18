<?php 

    include_once('../../../controller/MapController.php');
    $evacuations = $mapService->getEvacuationCenter();

    //THIS WILL SHOW A JSON DATA WHERE CONSUME BY MAP 
?>