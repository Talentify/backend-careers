<?php
/** BASE URL */
define("ROOT", "http://localhost/apiRouter/");

/** DATABASE CONNECT FIREBASE*/
define('firebase' , [
    'api_key'             => "AIzaSyDT_kvtVC8DFkXhNIHeHHBxXmETNbAdcwA",
    'auth_domain'         => "apijobs-84f74.firebaseapp.com",
    'database_url'        => "https://apijobs-84f74.firebaseio.com",
    'project_id'          => "apijobs-84f74",
    'storage_bucket'      => "apijobs-84f74.appspot.com",
    'messaging_sender_id' => "788367446426",
    'app_id'              => "1:788367446426:web:c7b9244319a89229ba2a23",
    'medição_id'          => "G-24N6LLKFTF",
]);

/**
 * @param string $path
 * @return string
 */
function url(string $path): string
{
    if ($path) {
        return ROOT . "{$path}";
    }
    return ROOT;
}

/**
 * @param string $message
 * @param string $type
 * @return string
 */
function message(string $message, string $type, $custom = false): string
{
    return "<div class=\"message {$type}\">{$message}</div>";
}