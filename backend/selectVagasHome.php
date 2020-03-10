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
 
// Include config file
require_once "config.php";


// Attempt search query execution
try{

        // create prepared statement
        $sql = "SELECT * FROM vagas where status = 1";
        $stmt = $pdo->prepare($sql);
        
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){

            if($row["status"] == 1){
                $row["status"] = 'Ativo';
            }else{
                $row["status"] = 'Finalizado';
            }


                echo "
                <h1 style='display:none' id='numvagas' title=".$stmt->rowCount()."></h1>
                <div class='col-md-4 mb-5 '>
                <div class='card h-100'>
                  <div class='card-body'>
                    <h2 class='card-title'>".$row["title"] ."</h2>
                    <p class='card-text'>".$row["description"] ."</p>
                    <h5>Salary: $".$row["salary"] ."</h5>
                    
                  </div>
                  <div class='card-footer'>
                    <a href='detalhavaga.php?vaga=".$row["id"] ."' class='btn btn-primary btn-sm'>Saiba Mais</a>
                  </div>
                </div>
              </div>";
            }
        } else{
           
            echo 0;
        }
      
} catch(PDOException $e){
    die("ERROR: Could not able to execute $sql. " . $e->getMessage());
}
 
// Close statement
unset($stmt);
 
// Close connection
unset($pdo);
?>