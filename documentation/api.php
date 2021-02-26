<?php
require("../vendor/autoload.php");
$openapi = \OpenApi\scan('../app/Http/Controllers');
if(isset($_GET['print'])){
    header('Content-Type: application/x-yaml');
    echo $openapi->toYaml();
    exit;
}

file_put_contents('../public/documentation/swagger.json', $openapi->toYaml());
