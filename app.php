<?php
session_start();
//Current working directory
$dir = __DIR__;

//Autoload vendor classes
require_once "$dir/vendor/autoload.php";

//Load environment variables
$dotenv = Dotenv\Dotenv::createImmutable($dir);
$dotenv->load();

//INCLUDES
include_once "$dir/includes/db.php";

//FUNCTIONS
include_once "$dir/functions/global.php";
include_once "$dir/functions/events.php";
include_once "$dir/functions/users.php";
include_once "$dir/functions/tickets.php";
include_once "$dir/functions/bookings.php";

 checkLogin();
