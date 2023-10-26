<?php
require_once '../app.php';
include_once "$dir/partial/header.php";

$query = "SELECT * FROM `events`";

$statement = $db->query($query);

$events = $statement->fetchAll(PDO::FETCH_OBJ);

$countTechnoQuery = 'SELECT COUNT(*) FROM `events` WHERE `type` = "techno"';
$countTechno = $db->query($countTechnoQuery);
$countTechno = $countTechno->fetchColumn();

$countDNBQuery = 'SELECT COUNT(*) FROM `events` WHERE `type` = "dnb"';
$countDNB = $db->query($countDNBQuery);
$countDNB = $countDNB->fetchColumn();

$countTotalQuery = 'SELECT COUNT(*) FROM `events`';
$countTotal = $db->query($countTotalQuery);
$countTotal = $countTotal->fetchColumn();

//tickets for first event => 0
$countVipTicketsQuery = 'SELECT `ticket_quantity` FROM `tickets` WHERE `events_id` = 1 AND `ticket_type` = "vip"';
$countVipTickets = $db->query($countVipTicketsQuery);
$countVipTickets = $countVipTickets->fetchColumn();

$countRegularTicketsQuery = 'SELECT `ticket_quantity` FROM `tickets` WHERE `events_id` = 1 AND `ticket_type` = "regular"';
$countRegularTickets = $db->query($countRegularTicketsQuery);
$countRegularTickets = $countRegularTickets->fetchColumn();

$countVipPlusTicketsQuery = 'SELECT `ticket_quantity` FROM `tickets` WHERE `events_id` = 1 AND `ticket_type` = "vip+"';
$countVipPlusTickets = $db->query($countVipPlusTicketsQuery);
$countVipPlusTickets = $countVipPlusTickets->fetchColumn();

$countTotalTickets = $countRegularTickets + $countVipPlusTickets + $countVipTickets;

?>

<h1>Dashboard</h1>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<div class="row">
    <canvas id="eventChart" width="300" height="200"></canvas>

    <script>
        var countTechno = <?php echo $countTechno; ?>;
        var countDNB = <?php echo $countDNB; ?>;
        var countTotal = <?php echo $countTotal; ?>;

        var ctx = document.getElementById('eventChart').getContext('2d');

        var eventChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Techno', 'DNB', 'Total'],
                datasets: [{
                    label: 'Event',
                    data: [countTechno, countDNB, countTotal],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    <canvas id="ticketChart" width="300" height="200"></canvas>

    <script>
        var countVipTickets = <?php echo $countVipTickets; ?>;
        var countRegularTickets = <?php echo $countRegularTickets; ?>;
        var countTotalTickets = <?php echo $countTotalTickets; ?>;
        var countVipPlusTickets = <?php echo $countVipPlusTickets; ?>;

        var ctx = document.getElementById('ticketChart').getContext('2d');

        var ticketChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Vip', 'Vip+', 'Regular', 'Total'],
                datasets: [{
                    label: 'Tickets',
                    data: [countVipTickets, countVipPlusTickets, countRegularTickets, countTotalTickets],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(75, 192, 192, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

</div>

<?php

include_once "$dir/partial/footer.php";
