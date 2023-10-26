<?php
require_once '../../app.php';
include_once "$dir/partial/header.php";
?>

<h1 class="">bookings</h1>

<div class="m-3">
    <a href="/bookings/editBookings.php" class="btn btn-success">Add bookings</a>
</div>

<div class="list-group">
    <div class="list-group-item bg-light">
        <div class="row justify-content-between">
            <div class="col-auto">
                Date
            </div>
            <div class="col-auto d-none d-lg-block">
                Budget
            </div>
            <div class="col-auto d-none d-lg-block">
                Event name
            </div>
        </div>
    </div>
    <?php

    $bookings = getBookings();

    foreach ($bookings as $booking) {
        include "$dir/views/bookings/item.php";
    }
    ?>
</div>

<?php
include_once "$dir/partial/footer.php";
