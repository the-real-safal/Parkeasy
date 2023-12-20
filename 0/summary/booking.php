<!DOCTYPE html>
<html>
<head>
    <title>Booking Summary Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Daily Booking Report</h1>
        <div id="chartContainer"></div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        // Encapsulate the code in a function to avoid global scope conflicts
        function renderBookingSummary() {
            const dates = summaryData.map(entry => entry.e_date);
            const counts = summaryData.map(entry => entry.count);

            const options = {
                chart: {
                    type: 'line'
                },
                xaxis: {
                    categories: dates
                },
                series: [
                    {
                        name: 'Number of Bookings',
                        data: counts
                    }
                ]
            };

            const chart = new ApexCharts(document.querySelector("#chartContainer"), options);
            chart.render();
        }

        document.addEventListener("DOMContentLoaded", function () {
            renderBookingSummary();
        });
    </script>
    <?php
        include("../inc/connect.php");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT DATE(e_date) AS e_date, COUNT(*) AS count FROM booking GROUP BY DATE(e_date)";
        $result = $conn->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo '<script>';
        echo 'var summaryData = ' . json_encode($data) . ';';
        echo '</script>';

        $conn->close();
    ?>
</body>
</html>
