<?php 
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");


class MapServices extends config {

        //THis part get All the Incident which pass to map for Mapping
        public function getEvacuationCenter() {
            try {
                $query = "SELECT `id`, `location_id`, `location_name`, `location_description`, `location_latitude`, `location_longhitude`, `location_current_no_of_evacuue`, `location_max_accommodate` FROM `tbl_evacuation_location` WHERE 1";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->execute(); // Execute the query
                $locations =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
            
                echo json_encode($locations); // Outputs locations as JSON
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

        

    
}
?>