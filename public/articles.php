<?php
require_once '../app.php';
include_once "$dir/partial/header.php";

?>

<h1>Articles</h1>

<div class="list-group">
<?php
$articles = getArticles();
foreach ($articles as $article) {
    include "$dir/views/articles/item.php";
}
?>
</div>

<?php
include_once "$dir/partial/footer.php";
