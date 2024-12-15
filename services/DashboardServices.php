<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class DashboardServices extends config {

    
    //////////////////////// DASHBOARD FUNCTION //////////////////////////////
    // THIS FUNCTION HANDLE TO COUNT ALL THE CALAMITIES HAPPEN THIS YEAR
    public function getCalamityThisYear() {
        try {
            $query = "SELECT `month_name`, `calamity_count` FROM `view_monthly_calamity_counts` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // THE FUNCTION HANDLE AND GET THE TOP CALAMITY HAPPPEND THIS YEAR
    public function topCalamityThisYear() {
        try {
            $query = "SELECT `calamity_type`, `calamity_count` FROM `view_top_calamity_type` WHERE 1 LIMIT 3";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    // COUNT ALL THE TOTAL EVACUATION AND ACTIVE CALAMITIES 
    public function getViewTotal() {
        try {
            $query = "SELECT `total_evacuations`, `active_calamities` FROM `view_total` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetch(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }


     //GET ALL THE CALAMITIES HAPPEN THIS YEAR
     public function getAllCalamityThisYear() {
        try {
            $query = "SELECT `id`, `calamity_active`, `calamity_date`, `calamity_time`, `calamity_description`, `status_id`, `status_level`, `status_color`, `status_description`, `type_calamity_id`, `type_calamity_type`, `type_calamity_description` FROM `calamities_this_year` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    
   //////////////////////// DASHBOARD FUNCTION //////////////////////////////
    

   
    // THIS FUNCTION HANDLE TO DELETE THE EVACUATION
    public function reportCalamity($calamity_id) {
        try {
            $query = "SELECT 
                            c.id,
                            c.calamity_description,
                            el.location_id,
                            el.location_name,
                            el.location_description,
                            e.fullname,
                            e.address,
                            e.age,
                            e.birthdate,
                            e.sex,
                            e.isPwd,
                            e.isSenior
                        FROM 
                            tbl_calamity c
                        LEFT JOIN 
                            tbl_evacuees_info e 
                            ON e.created_date BETWEEN c.calamity_date AND c.calamity_end_datetime
                        LEFT JOIN 
                            tbl_evacuation_location el
                            ON el.location_id = e.evacuation_locid
                        WHERE 
                            c.calamity_active = 0 && c.calamity_id = :calamity_id
                        GROUP BY 
                            c.id, el.location_id, el.location_name";

            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':calamity_id', $calamity_id );
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }


    // THIS FUNCTION HANDLE TO DELETE THE EVACUATION
    public function reportEvacuationStatuOnCalamity($calamity_id) {
        try {
            $query = "SELECT 
                            c.id,
                            c.calamity_description,
                            el.location_id,
                            el.location_name,
                            el.location_description,
                            COUNT(e.id) AS evacuee_count -- Count the number of evacuees in each evacuation location
                        FROM 
                            tbl_calamity c
                        LEFT JOIN 
                            tbl_evacuees_info e 
                            ON e.created_date BETWEEN c.calamity_date AND c.calamity_end_datetime
                        LEFT JOIN 
                            tbl_evacuation_location el
                            ON el.location_id = e.evacuation_locid
                        WHERE 
                            c.calamity_active = 0 
                            AND c.calamity_id = :calamity_id
                        GROUP BY 
                            c.id, 
                            el.location_id, 
                            el.location_name, 
                            el.location_description";
    
            // Prepare the query
            $stmt = $this->pdo->prepare($query);
            // Bind the calamity_id as a string
            $stmt->bindParam(':calamity_id', $calamity_id);

            $stmt->execute();
    
            // Fetch all results
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
            return $results; // Return the fetched data as an associative array
        } catch (PDOException $e) {
            // Log the error and return false
            error_log('Database Error: ' . $e->getMessage());
            return false;
        }
    }
    




}




?>
