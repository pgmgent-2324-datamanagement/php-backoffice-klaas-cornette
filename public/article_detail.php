<?php
require_once '../app.php';
include_once "$dir/partial/header.php";

?>

<h1>Edit article</h1>

<form>
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" class="form-control" id="title">
    </div>
    <div class="mb-3">
        <label for="content" class="form-label">Content</label>
        <textarea class="form-control" id="content" rows="3"></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>

<?php
include_once "$dir/partial/footer.php";
