<?php

function getArticles() {
    global $db;

    $sql = "SELECT * FROM articles";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}