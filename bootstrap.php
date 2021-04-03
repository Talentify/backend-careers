<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ERROR);

if (substr($_SERVER['DOCUMENT_ROOT'], -1) == '/') {
    define('DIR_ROOT', "{$_SERVER['DOCUMENT_ROOT']}");
} else {
    define('DIR_ROOT', "{$_SERVER['DOCUMENT_ROOT']}/");
}
define('DIR_PROJECT', 'varios_cursos_php/api_talentify/');
