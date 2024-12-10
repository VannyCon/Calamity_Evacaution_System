<?php 
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");


class MapServices extends config {

        //THis part get All the Incident which pass to map for Mapping
        public function getEvacuationCenter() {
            try {
                $query = "SELECT 
                            e.id,
                            e.location_id,
                            e.location_name,
                            e.location_description,
                            e.location_latitude,
                            e.location_longhitude,
                            e.location_current_no_of_evacuue,
                            e.location_max_accommodate,
                            e.facilitator_id,
                            f.facilitator_username,
                            f.facilitator_password,
                            f.facilitator_fullname,
                            f.facilitator_contact_number
                        FROM 
                            tbl_evacuation_location e
                        INNER JOIN 
                            tbl_facilitator_access f 
                        ON 
                            e.facilitator_id = f.id
                        WHERE 1;
                        ";
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