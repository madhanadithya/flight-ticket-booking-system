<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Flights</title>
    <link rel="stylesheet" type="text/css" href="list_flights_style.css">

</head>
<body>

    <h1>Booking Details</h1>
    <div class="btn">
        <button type="button" onclick="goToAdminPanel()">BACK</button>
    </div>
    <script>
        function goToAdminPanel() {
            window.location.href = 'adminpanel.html';
        }
    </script>

    <div id="flightsList">
        <?php
        include 'config.php'; 

        $sql = "SELECT * FROM booking"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="flights-table">';
            echo '<tr><th>From</th><th>To</th><th>Departure</th><th>Return</th><th>Trip Type</th><th>class</th><th>Pass count</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['bfrom'] . '</td>';
                echo '<td>' . $row['bto'] . '</td>';
                echo '<td>' . $row['departure'] . '</td>';
                echo '<td>' . $row['breturn'] . '</td>';
                echo '<td>' . $row['tripType'] . '</td>';
                echo '<td>' . $row['class'] . '</td>';
                echo '<td>' . $row['passcnt'] . '</td>';
                echo '</tr>';
            }

            echo '</table>';
        } else {
            echo '<p>No flights available</p>';
        }

        $conn->close();
        ?>
    </div>

</body>
</html>
