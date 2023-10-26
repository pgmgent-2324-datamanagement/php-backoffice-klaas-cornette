<?php

function getBookings()
{
    global $db;

    $stmt = $db->prepare("SELECT bookings.*, events.name AS event_name FROM bookings INNER JOIN events ON bookings.event_id = events.id");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_OBJ);
}
function getBookingsById($id)
{
    global $db;

    $stmt = $db->prepare("SELECT * FROM bookings WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_OBJ);
}
function setbookings($booking_date, $budget, $event_id)
{
    global $db;

    $stmt = $db->prepare("INSERT INTO bookings (booking_date, budget, event_id) VALUES (:date, :budget, :event_id)");
    $stmt->bindParam(':date', $booking_date);
    $stmt->bindParam(':budget', $budget);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->execute();

}

function updatebookings($id, $booking_date, $budget, $event_id)
{
    global $db;

    $stmt = $db->prepare("UPDATE bookings SET booking_date = :date, budget = :budget, event_id = :event_id WHERE id = :id");
    $stmt->bindParam(':date', $booking_date);
    $stmt->bindParam(':budget', $budget);
    $stmt->bindParam(':event_id', $event_id);
    $stmt->bindParam(':id', $id); 
    $stmt->execute();
}

function deleteBooking($id)
{
    global $db;

    $stmt = $db->prepare("DELETE FROM bookings WHERE id = :id");
    $stmt->bindValue(':id', $id);
    $stmt->execute();
}