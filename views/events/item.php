<?php require_once '../../app.php';
if(count($_POST)) {
    deleteEvent($_POST['event_id']);
}
 ?>
<a href="./edit.php?id=<?= $events->id ?>" class="list-group-item list-group-item-action">
    <div class="row justify-content-between">
        <div class="col-auto">
            <?= $events->name ?>
        </div>
        <div class="col-auto d-none d-lg-block">
            <?= $events->type ?>
        </div>
        <div class="col-3">
            <?= $events->date ?>
        </div>
        
    </div>
</a>

<form method="POST" id="deleteEventForm" class="m-2">
    <input type="hidden" name="event_id" value="<?= $events->id  ?>">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this event?')">Delete</button>
</form>
        