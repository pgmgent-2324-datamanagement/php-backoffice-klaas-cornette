<?php
require_once '../../app.php';
include_once "$dir/partial/header.php";

$events = getEvents();
$id = $_GET['id'] ?? 0;
$tickets = ($id) ? getTicketsById($id) : null;

if (count($_POST)) {
    
    $type = $_POST['type'] ?? '';
    $price = $_POST['price'] ?? '';
    $quantity = $_POST['quantity'] ?? '';
    $event_id = $_POST['ticket'] ?? null;

    if($id){
        updateTickets($id, $type, $price, $quantity, $event_id);
    }else{
        setTickets($type, $price, $quantity, $event_id);
    }
    redirect('/tickets/index.php');
}
?>

<h1>
    <?= ($id) ? 'Edit' : 'Add'; ?> tickets
</h1>

<form method="POST">
    <div class="mb-3">
        <label for="type" class="form-label">Type</label>
        <input type="text" class="form-control" name="type" id="type" value="<?= $_POST['type'] ?? $tickets->ticket_type ?? ''; ?>"
            maxlength="200">
    </div>
    <div class="mb-3">
        <label for="price" class="form-label">Price</label>
        <input type="text" class="form-control" name="price" id="price" value="<?= $_POST['price'] ?? $tickets->price ?? ''; ?>"
            maxlength="200">
    </div>
    <div class="mb-3">
        <label for="quantity" class="form-label">Quantity</label>
        <input type="text" class="form-control" name="quantity" id="quantity" value="<?= $_POST['quantity'] ?? $tickets->ticket_quantity ?? ''; ?>"
            maxlength="200">
    </div>
    <div class="mb-3">
        <select name="ticket" required>
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