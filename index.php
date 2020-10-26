<?php
ob_start();
session_start();
header('Content-Type: application/json; charset=UTF-8');

use CoffeeCode\Router\Router;
use Source\Controllers\AuthController;
use Source\Controllers\UsersController;
use Source\Controllers\JobsController;

require __DIR__ . "/vendor/autoload.php";

$router = new Router(ROOT);
$router->namespace("Source\Controllers");

$router->group('api');
$router->post('/admin/login', "AuthController:login", 'authcontroller.login');

$router->post("/admin/createJob", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new JobsController(), 'create'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->post("/admin/updateJob", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new JobsController(), 'updateJob'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->post("/admin/deleteJob", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new JobsController(), 'deleteJob'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->post("/admin/clearTableJobs", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new JobsController(), 'clearTable'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->get("/public/allJobs", "JobsController:showAllJobs");

$router->post("/admin/createUser", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new UsersController(), 'create'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->post("/admin/updateUser", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new UsersController(), 'updateUser'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->post("/admin/createAdmin", "UsersController:creteAdmin");

$router->post("/admin/deleteUser", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new UsersController(), 'deleteUser'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->post("/admin/clearTableUsers", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new UsersController(), 'clearTableUsers'), [$_POST]);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});

$router->get("/admin/allUser", function(){
    if(AuthController::checkAuth()){
        $response = call_user_func_array(array(new UsersController(), 'showAllUsers'), []);
        return json_encode(array('data' => $response, 'status' => 'sucess'));
        return;
    }
    echo json_encode([ 'status'=> 'error', 'msg' => 'Token Inválido']);
    return;
});


$router->dispatch();

if ($router->error()) {
    echo json_encode(['error' => $router->error()]);
    exit();
}

ob_end_flush();