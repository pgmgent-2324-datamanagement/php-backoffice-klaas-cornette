<?php require_once '../../app.php';
if(count($_POST)) {
    deleteBooking($_POST['booking_id']);
}
 ?>
<a href="./editBookings.php?id=<?= $booking->id ?>" class="list-group-item list-group-item-action">
    <div class="row justify-content-between">
        <div class="col-auto">
            <?= $booking->booking_date ?>
        </div>
        <div class="col-auto d-none d-lg-block">
            <?= $booking->budget ?>
        </div>  
        <div class="col-auto d-none d-lg-block">
            <?= $booking->event_name?>
        </div>
    </div>
</a>

<form method="POST" id="deleteBookingForm" class="m-2">
    <input type="hidden" name="booking_id" value="<?= $booking->id  ?>">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this booking?')">Delete</button>
</form>
        