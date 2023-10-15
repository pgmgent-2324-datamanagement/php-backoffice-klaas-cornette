<?php 

function redirect($url, $response_code = 301) {
    header("location: " . $url, true, $response_code);
    exit;
}