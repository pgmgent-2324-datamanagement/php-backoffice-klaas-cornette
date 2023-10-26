<?php 

function redirect($url, $response_code = 302) {
    header("location: " . $url, true, $response_code);
    exit;
}
function displayErrors($errors = []) {
    if(isset($errors) && count($errors) > 0) {
        foreach ( $errors as $error ) {
            echo "<div class='alert alert-danger'>$error</div>";
        } 
    }
}

 function checkLogin() {
     //check if not on login page
     if($_SERVER['REQUEST_URI'] == '/login.php' || $_SERVER['REQUEST_URI'] == '/register.php') {
         return;
     }
     if(!isset($_SESSION['login'])) {
         redirect('/login.php');
     }
}