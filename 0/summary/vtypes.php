<!DOCTYPE html>
<html>
<head>
    <title>Vehicle Type Linear Graph</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }

        .chart-container {
            display: flex;
            justify-content: center;
        }

        .chart {
            width: 70%; /* Adjust the width as needed */
        }

        .vehicle-type-chart {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Vehicle Type Chart</h1>
        <div class="chart-container">
            <div class="chart vehicle-type-chart" id="vehicleTypeChartContainer"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const vehicleTypeCounts = {
                1: 0, // Truck
                2: 0, // Car
                3: 0  // Van
            };

            summaryData.forEach(entry => {
                vehicleTypeCounts[entry.vehicle_type_id]++;
            });

            const vehicleTypeLabels = ['Truck', 'Car', 'Van'];

            const vehicleTypeOptions = {
    chart: {
        type: 'bar'
    },
    xaxis: {
        categories: vehicleTypeLabels
    },
    series: [
        {
            name: 'Number of Vehicles',
            data: Object.values(vehicleTypeCounts)
        }
    ],
    colors: ['#FF5733', '#36A2EB', '#FFC300'] // Specify colors for each bar
};

            const vehicleTypeChart = new ApexCharts(document.querySelector("#vehicleTypeChartContainer"), vehicleTypeOptions);
            vehicleTypeChart.render();
        });
    </script>
    <?php
        include ("inc/connect.php");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT vehicle_type_id
                  FROM booking";
        $result = $conn->query($query);

        $data = array();
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }

        echo '<script>';
        echo 'var summaryData = ' . json_encode($data) . ';';
        echo '</script>';
    ?>
</body>
</html>
