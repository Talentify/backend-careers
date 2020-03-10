<?php
// Include config file
// try{
//     $pdo = new \PDO("mysql:host=localhost;dbname=plataformavagasbataiero","root","");
//     // Set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e){
//     die("ERROR: Could not connect. " . $e->getMessage());
// }
 
// Include config file
require_once "config.php";


// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

 
    // Check input errors before inserting in database

        // Prepare an insert statement
        $sql = "INSERT INTO vagas (title,description,status,workplace,salary) VALUES (:title, :description, :status, :workplace, :salary)";
 
        if($stmt = $pdo->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bindParam(":title", $Title);
            $stmt->bindParam(":description", $Description);
            $stmt->bindParam(":status", $Status);
            $stmt->bindParam(":workplace", $Workplace);
            $stmt->bindParam(":salary", $Salary);

            // Set parameters
            $Title = trim($_POST["Title"]);
            $Description = trim($_POST["Description"]);
            $Status =  $_POST["Status"];
            $Workplace =  trim($_POST["Workplace"]);
            $Salary =  trim($_POST["Salary"]);
            
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                echo 1;

            } else{
                echo 0;
            }
        }
         
        // Close statement
        unset($stmt);
    
    
    // Close connection
    unset($pdo);
}
?>
