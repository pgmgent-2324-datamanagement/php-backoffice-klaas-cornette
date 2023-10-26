<?php
require_once '../../app.php';
include_once "$dir/partial/header.php";

$id = $_GET['id'] ?? 0;
$type = $_POST['type'] ?? '';
$date = $_POST['date'] ?? '';

$event = ($id) ? getEventById($id) : null;

$event_users = ($id) ? getUsersByEvent($id) : [];

$users = getUsers();

$tickets = getTickets();

if (count($_POST)) {
    //Gebruiker heeft op submit geklikt

    $errors = [];
    //validatie
    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_SPECIAL_CHARS);
    if (!$name) {
        $errors[] = 'Name is required';
    }
    $content = filter_input(INPUT_POST, 'content');
    $users_id = $_POST['users'] ?? [];
    $tickets_id = $_POST['ticket'] ?? null;
    if (count($errors) == 0) {
        if ($id) {
            //update
            updateEvent($id, $name, $type, $date, $users_id);
        } else {
            //insert
            insertEvent($name, $type, $date, $users_id);
        }
        redirect('/events/index.php');
    }
}
?>

<h1>
    <?= ($id) ? 'Edit' : 'Add'; ?> event
</h1>

<?php displayErrors($errors ?? []); ?>



<form method="POST">
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" id="name"
            value="<?= $_POST['name'] ?? $event->name ?? ''; ?>" maxlength="200">
    </div>
    <div class="mb-3">
        <label for="type" class="form-label">type</label>
        <input type="text" class="form-control" name="type" id="type"
            value="<?= $_POST['type'] ?? $event->type ?? ''; ?>" maxlength="200">
    </div>
    <div class="mb-3">
        <label for="date" class="form-label">date</label>
        <input type="text" class="form-control" name="date" id="date"
            value="<?= $_POST['date'] ?? $event->date ?? ''; ?>" maxlength="200">
    </div>
    <div class="mb-3">

        <?php foreach ($users as $user):
            $is_selected = in_array($user->id, $event_users) ? 'checked' : '';
            ?>
            <div><label>
                    <input type="checkbox" name="users[]" value="<?= $user->id; ?>" <?= $is_selected; ?>>
                    <?= $user->DJ_name ?>
                </label></div>
        <?php endforeach; ?>


    </div>
    <input type="hidden" name="id" value="<?= $id; ?>">
    <button type="submit" class="btn btn-primary">Submit</button>
</form>


<?php
include_once "$dir/partial/footer.php";
