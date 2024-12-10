<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class FacilitatorServices extends config {


    public function login($username, $password) {
        try {
            session_start();
            $query = "SELECT * FROM tbl_facilitator_access WHERE facilitator_username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Changed from fetchAll to fetch
            
            // Simple plain text password comparison
            if ($user && $password === $user['facilitator_username']) {
                $_SESSION['facilitator'] = $user['facilitator_username'];
                $_SESSION['facilitator_id'] = $user['id'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

    // THIS FUNCTION HANDLE THE READ ALL THE EVACUATION STATUS WHICH SUPPLY TO TABLE
    public function getEvacuationStatus($id) {
        try {
            $query = "SELECT `id`, `location_id`, `location_name`, `location_description`, `location_latitude`, `location_longhitude`, `location_current_no_of_evacuue`, `location_max_accommodate`, `facilitator_id` 
                      FROM `tbl_evacuation_location` 
                      WHERE `facilitator_id` = :id";
                      
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id, PDO::PARAM_INT); // Bind the :id parameter to the $id variable
            $stmt->execute(); // Execute the query
            
            $calamities = $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
            
            return $calamities; // Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    

    // Remove specific session variables so it will redirect the user to login
    public function logout() {
        session_start();
        // Unset specific session variables
        unset($_SESSION['facilitator']);
        // Redirect to the login page
        header("Location: index.php");
        return true;
    }
    
    
    public function addEvacuae($id, $evacuation_locid, $fullname, $address, $age, $birthdate, $sex, $isPwd, $isSenior) {
        try {
            // Begin transaction
            $this->pdo->beginTransaction();
    
            // First query: Insert evacuee info
            $query = "INSERT INTO `tbl_evacuees_info` (`evacuation_locid`, `fullname`, `address`, `age`, `birthdate`, `sex`, `isPwd`, `isSenior`, `isActive`, `created_date`) 
                      VALUES (:evacuation_locid, :fullname, :address, :age, :birthdate, :sex, :isPwd, :isSenior, 1, NOW())";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':evacuation_locid', $evacuation_locid);
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':isPwd', $isPwd);
            $stmt->bindParam(':isSenior', $isSenior);
            $stmt->execute(); // Execute the query
    
            // Second query: Update evacuation location current number
            $query1 = "UPDATE `tbl_evacuation_location` 
                       SET `location_current_no_of_evacuue` = `location_current_no_of_evacuue` + 1 
                       WHERE `id` = :id";
            $stmt2 = $this->pdo->prepare($query1); // Prepare the query
            $stmt2->bindParam(':id', $id);
            $stmt2->execute(); // Execute the query
    
            // Commit transaction
            $this->pdo->commit();
    
            return true; // Return true if both operations succeeded
        } catch (PDOException $e) {
            // Rollback transaction if any query fails
            $this->pdo->rollBack();
            error_log('Database Error: ' . $e->getMessage()); // Log the error
            return false;
        }
    }
    

    // THIS FUNCTION HANDLE THE READ ALL THE EVACUATION STATUS WHICH SUPPLY TO TABLE
    public function getEvacueByLocID($locID) {
        try {
            $query = "SELECT `id`, `evacuation_locid`, `fullname`, `address`, `age`, `birthdate`, `sex`, `isPwd`,`isSenior`, `isActive`, `created_date` FROM `tbl_evacuees_info` WHERE `evacuation_locid`=:locID &&  `isActive` = 1";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':locID', $locID);
            $stmt->execute(); // Execute the query
            $calamities =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return $calamities;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

        // GET ALLL THE ACTIVE ANNONCMENT WHICH SHOW IN USER AREA
        public function getAllFacilitator() {
            try {
                $query = "SELECT `id`, `facilitator_username`, `facilitator_password`, `facilitator_fullname`, `facilitator_contact_number` FROM `tbl_facilitator_access` WHERE 1";
                $stmt = $this->pdo->prepare($query); // Prepare the query
                $stmt->execute(); // Execute the query
                $announcement =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
            
                return  $announcement;// Outputs locations as JSON
            } catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
        }

    //CREATE facilitator
    public function createFacilitator($facilitator_username, $facilitator_password, $facilitator_fullname, $facilitator_contact_number) {
        try {

            $query = "INSERT INTO `tbl_facilitator_access` 
                        (`facilitator_username`, `facilitator_password`, `facilitator_fullname`, `facilitator_contact_number`) 
                        VALUES  
                        (:facilitator_username, :facilitator_password, :facilitator_fullname, :facilitator_contact_number)";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':facilitator_username', $facilitator_username);
            $stmt->bindParam(':facilitator_password', $facilitator_password);
            $stmt->bindParam(':facilitator_fullname', $facilitator_fullname);
            $stmt->bindParam(':facilitator_contact_number', $facilitator_contact_number);
            $stmt->execute(); // Execute the query
            return true;// Outputs locations as JSON
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
        
    }
    //UPDATE facilitator
    public function updateFacilitator($id, $facilitator_username, $facilitator_password, $facilitator_fullname, $facilitator_contact_number) {
        try {
            $query = "UPDATE `tbl_facilitator_access` 
                      SET `facilitator_username` = :facilitator_username,
                          `facilitator_password` = :facilitator_password,
                          `facilitator_fullname` = :facilitator_fullname,
                          `facilitator_contact_number` = :facilitator_contact_number 
                      WHERE id = :id";
    
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':facilitator_username', $facilitator_username);
            $stmt->bindParam(':facilitator_password', $facilitator_password);
            $stmt->bindParam(':facilitator_fullname', $facilitator_fullname);
            $stmt->bindParam(':facilitator_contact_number', $facilitator_contact_number);
    
            $stmt->execute(); // Execute the query
            return true;
        } catch (PDOException $e) {
            error_log('Database Error: ' . $e->getMessage()); // Log the error.
            return false;
        }
    }
    //DELETE facilitator
    public function deleteFacilitator($id) {
        try {
            $query = "DELETE FROM `tbl_facilitator_access` WHERE id=:id";
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