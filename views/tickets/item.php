<?php require_once '../../app.php';
if(count($_POST)) {
    deleteTicket($_POST['ticket']);
}
 ?>
<a href="./editTickets.php?id=<?= $ticket->id ?>" class="list-group-item list-group-item-action">
    <div class="row justify-content-between">
        <div class="col-auto">
            <?= $ticket->ticket_type ?>
        </div>
        <div class="col-auto d-none d-lg-block">
            <?= $ticket->price ?>
        </div>
        <div class="col-3">
            <?= $ticket->ticket_quantity ?>
        </div>
        
    </div>
</a>

<form method="POST" id="deleteTicketForm" class="m-2">
    <input type="hidden" name="ticket" value="<?= $ticket->id  ?>">
    <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this ticket?')">Delete</button>
</form>
        