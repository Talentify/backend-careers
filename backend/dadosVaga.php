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
    if(isset($_REQUEST["usuario"]) && isset($_REQUEST["senha"])){
        // create prepared statement
        $sql = "SELECT * FROM usuarios WHERE usuario = :usuario and senha = :senha";
        $stmt = $pdo->prepare($sql);
        $usuario = $_REQUEST["usuario"];
        $senha = $_REQUEST["senha"];
        // bind parameters to statement
        $stmt->bindParam(":usuario", $usuario);
        $stmt->bindParam(":senha", $senha);
        // execute the prepared statement
        $stmt->execute();
        if($stmt->rowCount() > 0){
            while($row = $stmt->fetch()){

                $_SESSION['login_ativo'] = 1;
                //echo "<p>" . $row["usuario"] . " - " . $row["senha"] ." - " . $row["email"]."</p>";
                echo 1;
            }
        } else{
            $_SESSION['login_ativo'] = 0;
            echo 0;
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