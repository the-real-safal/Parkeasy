<!DOCTYPE html>
<html>
<head>
    <title>Users Pie Chart</title>
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
            width: 80%; /* Adjust the width as needed */
        }

        .user-chart {
            background-color: #f2f2f2;
            border: 1px solid #ccc;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Users Chart</h1>
        <div class="chart-container">
            <div class="chart user-chart" id="userChartContainer"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const userTypes = userData.map(user => user.access);
            const userTypeCounts = {
                0: 0, // Super Admin
                1: 0, // Admin
                2: 0, // Normal User
                3: 0  // Restricted User
            };

            userTypes.forEach(type => {
                userTypeCounts[type]++;
            });

            const userTypeLabels = ['Super Admin', 'Admin', 'Normal User', 'Restricted User'];

            const userOptions = {
                chart: {
                    type: 'pie'
                },
                series: Object.values(userTypeCounts),
                labels: userTypeLabels,
                colors: ['#5e83ba', '#63c2de', '#2f855a', '#fd7e14']
            };

            const userChart = new ApexCharts(document.querySelector("#userChartContainer"), userOptions);
            userChart.render();
        });
    </script>
    <?php
        include ("inc/connect.php");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $userQuery = "SELECT access FROM users";
        $userResult = $conn->query($userQuery);

        $userData = array();
        while ($row = $userResult->fetch_assoc()) {
            $userData[] = $row;
        }

        echo '<script>';
        echo 'var userData = ' . json_encode($userData) . ';';
        echo '</script>';
    ?>
</body>
</html>
