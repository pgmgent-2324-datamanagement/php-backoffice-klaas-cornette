<?php
require_once '../../app.php';
include_once "$dir/partial/header.php";

$events = getEvents();
$id = $_GET['id'] ?? 0;
$bookings = ($id) ? getBookingsById($id) : null;

if (count($_POST)) {
    $event_id = $_POST['event'] ??0;
    $date = $_POST['date'] ?? '';
    $price = $_POST['price'] ?? '';

    if($id){
        updatebookings($id, $date, $price, $event_id);
    }else{
        setbookings($date, $price, $event_id);
    }
    redirect('/bookings/index.php');
}
?>

<h1>
    <?= ($id) ? 'Edit' : 'Add'; ?> bookings
</h1>

<form method="POST">
    <div class="mb-3">
        <label for="date" class="form-label">Date</label>
        <input type="text" class="form-control" name="date" id="date" value="<?= $_POST['date'] ?? $bookings->booking_date ?? ''; ?>"
            maxlength="200">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Budget</label>
        <input type="text" class="form-control" name="price" id="price" value="<?= $_POST['price'] ?? $bookings->budget ?? ''; ?>"
            maxlength="200">
    </div>
    <div class="mb-3">
        <select name="event" required>
            <option value="">Select a event</option>
            <?php foreach ($events as $event):
                ?>
                <option value="<?= $event->id; ?>">
                    <?= $event->name; ?>
                </option>
            <?php endforeach; ?>
        </select>
    </div>
    <input type="hidden" name="id" value="<?= $id; ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>