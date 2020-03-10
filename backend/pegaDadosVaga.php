<?php
session_start();
/* Attempt MySQL server connection. Assuming you are running MySQL
server with default setting (user 'root' with no password) */
// try{
//     $pdo = new \PDO("mysql:host=localhost;dbname=plataformavagasbataiero","root","");
//     // Set the PDO error mode to exception
//     $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
// } catch(PDOException $e){
//     die("ERROR: Could not connect. " . $e->getMessage());
// }

require_once "config.php";


// Attempt search query execution
try{
    if(isset($_REQUEST["vaga"])){
        // create prepared statement
        $sql = "SELECT * FROM vagas WHERE id = :vaga";
        $stmt = $pdo->prepare($sql);
        $vaga = $_REQUEST["vaga"];
        
        // bind parameters to statement
        $stmt->bindParam(":vaga", $vaga);

        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){
                echo json_encode($row);
            }
        } else{

        }
    }  
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>