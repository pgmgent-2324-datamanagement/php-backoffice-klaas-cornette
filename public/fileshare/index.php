<?php
if (count($_POST)) {
    $file = $_FILES['file'];
    $name = $file['name'];
    $tmp_name = $file['tmp_name'];

    $extension = pathinfo($name, PATHINFO_EXTENSION);

    $newName = 'user' . '.' . $extension;

    $uploadDirectory = __DIR__ . '/uploads/';

    $previousFiles = scandir($uploadDirectory);
    foreach ($previousFiles as $previousFile) {
        if ($previousFile != '.' && $previousFile != '..') {
            unlink($uploadDirectory . $previousFile);
        }
    }

    move_uploaded_file($tmp_name, $uploadDirectory . $newName);
}

$items = scandir(__DIR__ . '/uploads');

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FileDrop</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container">
        <div class="cart">
            <a class="redbutton" href="/">Go back</a>
            <h1 class="display-4">Change profile picture</h1>

            <div class="files">
                <div class="row font-weight-bold">
                    <div class="col">File</div>
                    <div class="col">Size</div>
                </div>

                <?php foreach ($items as $item): ?>
                    <?php if ($item === '.' || $item === '..')
                        continue; ?>
                    <div class="row">
                        <div class="col">
                            <?= $item ?>
                        </div>
                        <div class="col">
                            <?= filesize(__DIR__ . '/uploads/' . $item); ?>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <form class="upload" method="POST" enctype="multipart/form-data">
                <input type="hidden" name="test" value="test">
                <div class="form-group">
                    <input type="file" name="file" id="file" class="form-control-file">
                </div>
                <button type="submit" class="btn btn-primary">Upload</button>
            </form>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>

</html>