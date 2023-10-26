<?php

function getEvents($search = '', $type = '') {
    global $db;

    $sql = "SELECT * FROM events WHERE 1"; // WHERE 1 is a placeholder to start the query

    $params = array();

    if ($search) {
        $sql .= " AND (name LIKE :search OR type LIKE :search)";
        $params[':search'] = "%$search%";
    }

    if ($type) {
        $sql .= " AND type = :type";
        $params[':type'] = $type;
    }

    $stmt = $db->prepare($sql);

    foreach ($params as $param => $value) {
        $stmt->bindValue($param, $value);
    }

    $stmt->execute();
    
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}

function getEventById($id) {
    global $db;

    $stmt = $db->prepare("SELECT * FROM events WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}   

function compareEvents($event1, $event2) {
    $date1 = $event1->date;
    $date2 = $event2->date;

    if ($date1 == $date2) {
        return 0;
    }

    return ($date1 < $date2) ? -1 : 1;
}

function updateEvent($id, $name, $type, $date, $users_id) {
    global $db;

    $stmt = $db->prepare("UPDATE events SET name = :name, type = :type, date = :date WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':date', $date);
    $stmt->execute();

    updateEventUser($id, $users_id);
    
}

function insertEvent($name, $type, $date, $users_id) {
    global $db;

    $stmt = $db->prepare("INSERT INTO events (name, type, date) VALUES (:name, :type, :date )");
    $stmt->bindValue(':name', $name);
    $stmt->bindValue(':type', $type);
    $stmt->bindValue(':date', $date);
    $stmt->execute();

    $event_id = $db->lastInsertId();
    updateEventUser($event_id, $users_id);
}

function updateEventUser($event_id, $users_id) {
    global $db;

    $users_id = array_map('intval', $users_id);

    foreach ($users_id as $user_id) {
        print_r($user_id);
    }

    $stmt = $db->prepare("DELETE FROM users_has_events WHERE events_id = :events_id");
    $stmt->bindValue(':events_id', $event_id);
    $stmt->execute();

    foreach ($users_id as $user_id) {
        $stmt = $db->prepare("INSERT INTO users_has_events (events_id, users_id) VALUES (:events_id, :users_id)");
        $stmt->bindValue(':events_id', $event_id);
        $stmt->bindValue(':users_id', $user_id);
        $stmt->execute();
    }
}


function deleteEvent($id) {
    global $db;

    $stmtDeleteTicketsEvents = $db->prepare("DELETE FROM tickets WHERE events_id = :id");
    $stmtDeleteTicketsEvents->bindParam(':id', $id);
    $stmtDeleteTicketsEvents->execute();

    // Delete related rows in users_has_events table first
    $stmtDeleteUsersEvents = $db->prepare("DELETE FROM users_has_events WHERE events_id = :id");
    $stmtDeleteUsersEvents->bindParam(':id', $id);
    $stmtDeleteUsersEvents->execute();

    // Now delete the event
    $stmt = $db->prepare("DELETE FROM events WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->execute();
}
