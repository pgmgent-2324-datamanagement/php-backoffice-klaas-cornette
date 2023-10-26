<?php
require_once '../../app.php';
include_once "$dir/partial/header.php";
?>

<h1 class="">Tickets</h1>

<div class="m-3">
    <a href="/tickets/editTickets.php" class="btn btn-success">Add tickets</a>
</div>

<div class="list-group">
    <div class="list-group-item bg-light">
        <div class="row justify-content-between">
            <div class="col-auto">
                Type
            </div>
            <div class="col-auto d-none d-lg-block">
                Price
            </div>
            <div class="col-3">
                Quantity
            </div>
        </div>
    </div>
    <?php

    $tickets = getTickets();

    foreach ($tickets as $ticket) {
        include "$dir/views/tickets/item.php";
    }
    ?>
</div>

<?php
include_once "$dir/partial/footer.php";
