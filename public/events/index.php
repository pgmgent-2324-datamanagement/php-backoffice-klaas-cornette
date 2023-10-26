<?php
require_once '../../app.php';
include_once "$dir/partial/header.php";
?>

<h1>Events</h1>

<form class="form" method="GET">
    <div class="row mb-4">
        <div class="col-auto">
            <input type="text" name="search" id="search" class="form-control" placeholder="Searchterm">
        </div>
        <div class="col-auto">
            <select name="type" id="type" class="form-control">
                <option value="">All</option>
                <option value="techno">Techno</option>
                <option value="dnb">Drum and Bass</option>
            </select>
        </div>
        <div class="col-auto">
            <select name="sort" id="sort" class="form-control">
                <option value="asc">Sort by Date (Ascending)</option>
                <option value="desc">Sort by Date (Descending)</option>
            </select>
        </div>
        <div class="col-auto">
            <button type="submit" class="btn btn-primary">Search</button>
        </div>
        <div class="col text-end">
            <a href="/events/edit.php" class="btn btn-success">Add event</a>
        </div>
    </div>

</form>

<div class="list-group">
    <div class="list-group-item bg-light">
        <div class="row justify-content-between">
            <div class="col-auto">
                Name
            </div>
            <div class="col-auto d-none d-lg-block">
                Type
            </div>
            <div class="col-3">
                Date
            </div>
        </div>
    </div>
    <?php
    $search = $_GET['search'] ?? '';
    $type = $_GET['type'] ?? '';
    $sort = $_GET['sort'] ?? 'asc';

    $events = getEvents($search, $type);
    
    if ($sort == 'desc') {
        usort($events, 'compareEvents');
        $events = array_reverse($events);
    } else {
        usort($events, 'compareEvents');
    }

    foreach ($events as $events) {
        include "$dir/views/events/item.php";
    }
    ?>
</div>

<?php
include_once "$dir/partial/footer.php";
