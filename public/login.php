<?php
require_once '../app.php';
include_once "$dir/partial/header.php";

$correct_user = 'admin';
$correct_pass_hash = '$2y$10$xudaFtSG/4xKQv/FEg15F.08oBx8e7CYWaxfnByabPWAVfE1yWqg.';

$login = $_POST['login']  ?? '';
$password = $_POST['password'] ?? '';



if(isset ($_POST['login']) && isset($_POST['password'])) {
    if( password_verify($password, $correct_pass_hash) ) {
        echo 'correct';
        $_SESSION['login'] = $login;
        redirect('index.php');
        
    } else {
        $_SESSION['login'] = null;
        echo 'incorrect'; 
    }
}

?>

<h1>Login</h1>

<form  method="POST" action="">
<div class="mb-3 row">
<label for="login" class="col-sm-2 col-form-label">Login</label>
    <div class="col-sm-10">
      <input type="text" name="login" class="form-control" id="login">
    </div>
  </div>
  <div class="mb-3 row">
    <label for="inputPassword" class="col-sm-2 col-form-label">Password</label>
    <div class="col-sm-10">
      <input type="password" name="password" class="form-control" id="inputPassword">
    </div>
  </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>



<?php

include_once "$dir/partial/footer.php";
