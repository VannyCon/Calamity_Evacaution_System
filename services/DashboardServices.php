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
    
   //////////////////////// DASHBOARD FUNCTION //////////////////////////////
    



}




?>
