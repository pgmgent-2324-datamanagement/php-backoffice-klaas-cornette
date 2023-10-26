<?php

function getUsers() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM users");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getUsersByEvent($event_id) {
    global $db;

    $stmt = $db->prepare("SELECT users_id FROM users_has_events WHERE events_id = :events_id");
    $stmt->bindValue(':events_id', $event_id);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_COLUMN);
}

