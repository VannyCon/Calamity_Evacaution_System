<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class CalamityServices extends config {

    // GET ACTIVE CALAMITY
    public function getActiveCalamity() {
        try {
            $query = "SELECT 
                            c.id,
                            c.calamity_active,
                            c.calamity_date,
                            c.calamity_time,
                            cs.status_id,
                            cs.status_level,
                            cs.status_color,
                            cs.status_description,
                            tc.type_calamity_id,
                            tc.type_calamity_type,
                            tc.type_calamity_description

                        FROM 
                            tbl_calamity c

                        JOIN 
                            tbl_calamity_status cs 
                            ON c.calamity_status_id = cs.status_id

                        JOIN 
                            tbl_type_of_calamity tc 
                            ON c.calamity_type_id = tc.type_calamity_id
                        WHERE
                            c.calamity_active = 1
                        ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    // GET NOT ACTIVE CALAMITY
    public function getNotActiveCalamity() {
        try {
            $query = "SELECT 
                            c.id,
                            c.calamity_active,
                            c.calamity_date,
                            c.calamity_time,
                            cs.status_level,
                            cs.status_color,
                            cs.status_description,
                            tc.type_calamity_type,
                            tc.type_calamity_description

                        FROM 
                            tbl_calamity c

                        JOIN 
                            tbl_calamity_status cs 
                            ON c.calamity_status_id = cs.status_id

                        JOIN 
                            tbl_type_of_calamity tc 
                            ON c.calamity_type_id = tc.type_calamity_id
                        WHERE
                            c.calamity_active = 0
                        ";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    
    // Function to generate unique calamity ID
    function generateCalamityID() {
        // Prefix (optional) for the calamity ID (e.g., "calamity-")
        $prefix = "CALAMITY-";
        
        // Get the current timestamp in microseconds
        $timestamp = microtime(true);
        
        // Generate a random number to add more uniqueness
        $randomNumber = mt_rand(100000, 999999);
        
        // Hash the timestamp and random number to create a unique identifier
        $uniqueHash = hash('sha256', $timestamp . $randomNumber);
        
        // Take the first 12 characters of the hash (or any desired length)
        $calamityID = substr($uniqueHash, 0, 10);
        
        // Return the final calamity ID with prefix
        return $prefix . strtoupper($calamityID);
    }

    // THIS FUNCTION HANDLE TO UPDATE THE CALAMITY
    public function createCalamity($calamity_type_id, $calamity_status_id, $calamity_date, $calamity_time) {
        try {

            $calamityID = $this->generateCalamityID();
            $query = "INSERT INTO `tbl_calamity` 
                        (`calamity_id`, `calamity_type_id`, `calamity_status_id`, `calamity_active`, `calamity_date`, `calamity_time`) 
                        VALUES  
                        (:calamityID, :calamity_type_id, :calamity_status_id, 1,:calamity_date, :calamity_time)";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':calamityID', $calamityID);
            $stmt->bindParam(':calamity_type_id', $calamity_type_id);
            $stmt->bindParam(':calamity_status_id', $calamity_status_id);
            $stmt->bindParam(':calamity_date', $calamity_date);
            $stmt->bindParam(':calamity_time', $calamity_time);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }
    // THIS FUNCTION HANDLE TO UPDATE THE CALAMITY
    public function updateCalamity($id, $calamity_type_id, $calamity_status_id, $calamity_active, $calamity_date, $calamity_time) {
        try {
            $query = "UPDATE `tbl_calamity` SET `calamity_type_id`= :calamity_type_id,`calamity_status_id`=:calamity_status_id,`calamity_active`=:calamity_active,`calamity_date`=:calamity_date,`calamity_time`=:calamity_time WHERE id=:id";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':calamity_type_id', $calamity_type_id);
            $stmt->bindParam(':calamity_status_id', $calamity_status_id);
            $stmt->bindParam(':calamity_active', $calamity_active);
            $stmt->bindParam(':calamity_date', $calamity_date);
            $stmt->bindParam(':calamity_time', $calamity_time);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            return false;
        }
    }
    // THIS FUNCTION USE TO REACTIVE THE SPECIFIC CALAMITY
    public function reactiveCalamity($id) {
        try {
            $query = "UPDATE `tbl_calamity` SET `calamity_active`= 1 WHERE id=:id";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }


}




?>
