<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class FacilitatorServices extends config {


    public function login($username, $password) {
        try {
            session_start();
            $query = "SELECT * FROM tbl_facilitator_access WHERE username = :username";
            $stmt = $this->pdo->prepare($query);
            $stmt->bindParam(':username', $username);
            $stmt->execute();
            $user = $stmt->fetch(PDO::FETCH_ASSOC); // Changed from fetchAll to fetch
            
            // Simple plain text password comparison
            if ($user && $password === $user['password']) {
                $_SESSION['facilitator'] = $user['username'];
                return true;
            }
            return false;
        } catch (PDOException $e) {
            error_log("Database error: " . $e->getMessage());
            return false;
        }
    }

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

    // Remove specific session variables so it will redirect the user to login
    public function logout() {
        session_start();
        // Unset specific session variables
        unset($_SESSION['facilitator']);
        // Redirect to the login page
        header("Location: index.php");
        return true;
    }
    
    
    public function addEvacuae($id, $fullname, $address, $age, $birthdate, $sex, $isPwd) {
        try {
            // Begin transaction
            $this->pdo->beginTransaction();
    
            // First query: Insert evacuee info
            $query = "INSERT INTO `tbl_evacuees_info` (`fullname`, `address`, `age`, `birthdate`, `sex`, `isPwd`) 
                      VALUES (:fullname, :address, :age, :birthdate, :sex, :isPwd)";
            $stmt = $this->pdo->prepare($query); // Prepare the query
            $stmt->bindParam(':fullname', $fullname);
            $stmt->bindParam(':address', $address);
            $stmt->bindParam(':age', $age);
            $stmt->bindParam(':birthdate', $birthdate);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':isPwd', $isPwd);
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
    
}
?>