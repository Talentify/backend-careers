<?php

require_once "vendor/autoload.php";
require_once "bootstrap.php";

use Api\Validator\RequestValidator;
use Api\Util\ParseUrlUtil;

try {
    $request = new RequestValidator(ParseUrlUtil::getRoute());
    $request->requestValidate();
} catch (\Exception $e) {
    echo "Erro: " . $e->getMessage();
}
