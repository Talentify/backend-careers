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

        // create prepared statement
        $sql = "SELECT * FROM vagas";
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
                    <tr>
                    <td>".$row["title"] ."</td>
                    <td>".$row["description"] ."</td>
                    <td>".$row["workplace"] ."</td>
                    <td>".$row["salary"] ."</td>
                    <td>".$row["status"] ."</td>
                    <td><a href='../backend/delVaga.php?vaga=".$row["id"] ."'><img src='img/del.png' width='15px' style='cursor:pointer' class='btn_del'</a>
                    </td>
                    </tr>";
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