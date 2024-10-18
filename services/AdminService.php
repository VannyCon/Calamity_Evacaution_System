<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class AdminServices extends config {

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

    public function getActiveAnnouncement() {
        try {
            $query = "SELECT 
                            `id`, 
                            `announcement_title`, 
                            `announcement_description`, 
                            `announcement_date`, 
                            `announcement_time`
                        FROM 
                            `tbl_announcement` 
                        ORDER BY 
                            `announcement_date` & `announcement_time` DESC";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }



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

    // Function to generate unique patient ID
    function generateCalamityID() {
        // Prefix (optional) for the patient ID (e.g., "patient-")
        $prefix = "CALAMITY-";
        
        // Get the current timestamp in microseconds
        $timestamp = microtime(true);
        
        // Generate a random number to add more uniqueness
        $randomNumber = mt_rand(100000, 999999);
        
        // Hash the timestamp and random number to create a unique identifier
        $uniqueHash = hash('sha256', $timestamp . $randomNumber);
        
        // Take the first 12 characters of the hash (or any desired length)
        $patientID = substr($uniqueHash, 0, 10);
        
        // Return the final patient ID with prefix
        return $prefix . strtoupper($patientID);
    }

        // Function to generate unique patient ID
        function generateLocID() {
            // Prefix (optional) for the patient ID (e.g., "patient-")
            $prefix = "LOCID-";
            
            // Get the current timestamp in microseconds
            $timestamp = microtime(true);
            
            // Generate a random number to add more uniqueness
            $randomNumber = mt_rand(100000, 999999);
            
            // Hash the timestamp and random number to create a unique identifier
            $uniqueHash = hash('sha256', $timestamp . $randomNumber);
            
            // Take the first 12 characters of the hash (or any desired length)
            $patientID = substr($uniqueHash, 0, 10);
            
            // Return the final patient ID with prefix
            return $prefix . strtoupper($patientID);
        }


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



    public function createAnnouncement($announcement_title, $announcement_description, $announcement_date, $announcement_time) {
        try {

            $calamityID = $this->generateCalamityID();
            $query = "INSERT INTO `tbl_announcement` 
                        (`announcement_title`, `announcement_description`, `announcement_date`, `announcement_time`) 
                        VALUES  
                        (:announcement_title, :announcement_description, :announcement_date, :announcement_time)";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':announcement_title', $announcement_title);
            $stmt->bindParam(':announcement_description', $announcement_description);
            $stmt->bindParam(':announcement_date', $announcement_date);
            $stmt->bindParam(':announcement_time', $announcement_time);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }

    public function updateAnnouncement($id, $announcement_title, $announcement_description, $announcement_date, $announcement_time) {
        try {
            $query = "UPDATE `tbl_announcement` 
                      SET `announcement_title` = :announcement_title,
                          `announcement_description` = :announcement_description,
                          `announcement_date` = :announcement_date,
                          `announcement_time` = :announcement_time 
                      WHERE id = :id";
    
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':announcement_title', $announcement_title);
            $stmt->bindParam(':announcement_description', $announcement_description);
            $stmt->bindParam(':announcement_date', $announcement_date);
            $stmt->bindParam(':announcement_time', $announcement_time);
    
            $stmt->execute(); // Execute the query
            return true;
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
    }
    
    public function deleteAnnouncement($id) {
        try {
            $query = "DELETE FROM `tbl_announcement` WHERE id=:id";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
    }

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


}




?>
