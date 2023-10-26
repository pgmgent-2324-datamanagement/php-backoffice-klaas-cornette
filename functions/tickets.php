<?php

function getTickets() {
    global $db;

    $stmt = $db->prepare("SELECT * FROM tickets");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getTicketsById($id) {
    global $db;
    $stmt = $db->prepare("SELECT * FROM tickets WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}
function setTickets($type, $price, $quantity, $event_id) {
    global $db;

    $stmt = $db->prepare("INSERT INTO tickets (ticket_type, price, ticket_quantity, events_id) VALUES (:type, :price, :quantity, :event_id)");
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();

}

function updateTickets($id, $type, $price, $quantity, $event_id) {
    global $db;

    $stmt = $db->prepare("UPDATE tickets SET ticket_type = :type, price = :price, ticket_quantity = :quantity, events_id = :event_id WHERE id = :id");
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':type', $type);
    $stmt->bindParam(':price', $price);
    $stmt->bindParam(':quantity', $quantity);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();
}

function deleteTicket($id) {
    global $db;

    $stmt = $db->prepare("DELETE FROM tickets WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}