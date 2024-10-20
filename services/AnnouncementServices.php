<?php
require_once("../../../connection/config.php");
require_once("../../../connection/connection.php");

class AnnouncementServices extends config {

    // GET ALLL THE ACTIVE ANNONCMENT WHICH SHOW IN USER AREA
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
            $announcement =  $stmt->fetchAll(PDO::FETCH_ASSOC); // Fetch the result
        
            return  $announcement;// Outputs locations as JSON
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    //CREATE ANNOUNCEMENT
    public function createAnnouncement($announcement_title, $announcement_description, $announcement_date, $announcement_time) {
        try {

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
    //UPDATE ANNOUNCEMENT
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
    //DELETE ANNOUNCEMENT
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

}




?>
