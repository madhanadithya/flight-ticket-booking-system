<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Available Flights</title>
    <link rel="stylesheet" type="text/css" href="list_flights_style.css">

</head>
<body>

    <h1>Available Flights</h1>
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
        include 'config.php'; // Include the database connection file

        $sql = "SELECT * FROM flights"; 
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo '<table class="flights-table">';
            echo '<tr><th>From</th><th>To</th><th>Departure</th><th>Arrival</th><th>Duration</th><th>Airline</th><th>Price</th></tr>';

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . $row['ffrom'] . '</td>';
                echo '<td>' . $row['fto'] . '</td>';
                echo '<td>' . $row['departure'] . '</td>';
                echo '<td>' . $row['arrival'] . '</td>';
                echo '<td>' . $row['duration'] . '</td>';
                echo '<td>' . $row['airline'] . '</td>';
                echo '<td>' . $row['price'] . '</td>';
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
