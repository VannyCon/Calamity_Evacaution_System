<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class EvacuationServices extends config {

    // THIS FUNCTION HANDLE THE READ ALL THE EVACUATION STATUS WHICH SUPPLY TO TABLE
    public function getEvacuationStatus() {
        try {
            $query = "SELECT `id`, `location_id`, `location_name`, `location_description`, `location_latitude`, `location_longhitude`, `location_current_no_of_evacuue`, `location_max_accommodate` FROM `tbl_evacuation_location` WHERE 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

    //TO UPDATE THE CURRENT AND MAX OF THE SPECIFIC EVACUATION CENTER THIS ONLY UPDATE THE CURRENT AND MAX
    public function updateEvacuationStatus($id, $current, $max) {
        try {
            $query = "UPDATE `tbl_evacuation_location` SET `location_current_no_of_evacuue`=:current,`location_max_accommodate`=:max WHERE id=:id";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':current', $current);
            $stmt->bindParam(':max', $max);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            return false;
        }
    }

    
    // Function to generate unique loc ID
    function generateLocID() {
        // Prefix (optional) for the loc ID (e.g., "loc-")
        $prefix = "LOCID-";
        
        // Get the current timestamp in microseconds
        $timestamp = microtime(true);
        
        // Generate a random number to add more uniqueness
        $randomNumber = mt_rand(100000, 999999);
        
        // Hash the timestamp and random number to create a unique identifier
        $uniqueHash = hash('sha256', $timestamp . $randomNumber);
        
        // Take the first 12 characters of the hash (or any desired length)
        $locID = substr($uniqueHash, 0, 10);
        
        // Return the final loc ID with prefix
        return $prefix . strtoupper($locID);
    }

    // THIS FUNCTION CREATE A EVACAUTION LOCATION
    public function createEvacuationLocation($location_name, $location_description, $location_latitude, $location_longhitude, $location_current_no_of_evacuue, $location_max_accommodate) {
        try {

            $locID = $this->generateLocID();
            $query = "INSERT INTO `tbl_evacuation_location`(`location_id`, `location_name`, `location_description`, `location_latitude`, `location_longhitude`, `location_current_no_of_evacuue`, `location_max_accommodate`) 
            VALUES (:locID, :location_name, :location_description, :location_latitude, :location_longhitude, :location_current_no_of_evacuue, :location_max_accommodate)";

            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':locID', $locID );
            $stmt->bindParam(':location_name', $location_name);
            $stmt->bindParam(':location_description', $location_description);
            $stmt->bindParam(':location_latitude', $location_latitude);
            $stmt->bindParam(':location_longhitude', $location_longhitude);
            $stmt->bindParam(':location_current_no_of_evacuue', $location_current_no_of_evacuue);
            $stmt->bindParam(':location_max_accommodate', $location_max_accommodate);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }

    // THIS FUNCTION HANDLE TO DELETE THE EVACUATION
    public function deleteEvacuationLocation($locID) {
        try {
            $query = "DELETE FROM `tbl_evacuation_location` WHERE location_id=:locID";

            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':locID', $locID );
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }

    // THIS FUNCTION HANDLE TO UPDATE THE EVACUATIN
    public function updateLocation($locID, $location_name, $location_description,  $location_latitude, $location_longhitude) {
        try {
            $query = "UPDATE `tbl_evacuation_location` SET `location_name`=:location_name, `location_description`=:location_description, `location_latitude`=:location_latitude,`location_longhitude`=:location_longhitude WHERE location_id=:locID";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':locID', $locID);
            $stmt->bindParam(':location_name', $location_name);
            $stmt->bindParam(':location_description', $location_description);
            $stmt->bindParam(':location_latitude', $location_latitude);
            $stmt->bindParam(':location_longhitude', $location_longhitude);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }


}




?>
