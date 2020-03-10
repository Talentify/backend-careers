<?php

echo $_GET['vaga'];

// Include config file
try{
    // $pdo = new \PDO("mysql:host=localhost;dbname=plataformavagasbataiero","root","");
    // // Set the PDO error mode to exception
    // $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

// Include config file
require_once "config.php";


} catch(PDOException $e){
    die("ERROR: Could not connect. " . $e->getMessage());
}
 
   // Prepare a delete statement
   $sql = "DELETE FROM vagas WHERE id = :id";
    
   if($stmt = $pdo->prepare($sql)){
       // Bind variables to the prepared statement as parameters
       $stmt->bindParam(":id", $vaga);
       
       // Set parameters
       $vaga = trim($_GET["vaga"]);
       
       // Attempt to execute the prepared statement
       if($stmt->execute()){
           // Records deleted successfully. Redirect to landing page
           header("location: ../admin/gerencia_vagas.php");
           //exit();



       } else{
           echo "Oops! Something went wrong. Please try again later.";
       }
   }
    
   // Close statement
   unset($stmt);
   
   // Close connection
   unset($pdo);

?>
