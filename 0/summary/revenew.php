<!DOCTYPE html>
<html>
<head>
    <title>Booking Summary Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
          <style>
        body {
            background-color: #f4f4f4;
        }

        .container {
            margin-top: 50px;
        }

        .chart-container {
            display: flex;
            justify-content: space-between;
        }

        .chart {
            width: 100%;
            margin-bottom: 20px;
        }

        .charge-chart {
            background-color: #f8f8f8;
            border: 1px solid #ddd;
            padding: 10px;
            border-radius: 5px;
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h1 class="text-center">Revenue Summary Report</h1>
        <div class="chart-container">
            <div class="chart charge-chart" id="chargeChartContainer"></div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            var options = {
                chart: {
                    type: 'line',
                    height: 350
                },
                series: [{
                    name: 'Total Charges',
                    data: summaryData.map(entry => ({
                        x: new Date(entry.d_date).getTime(),
                        y: entry.charge
                    }))
                }],
                xaxis: {
                    type: 'datetime',
                    min: new Date('2023-08-01').getTime(), // Set the minimum date
                    labels: {
                        datetimeUTC: false // Display local date and time on x-axis
                    }
                },
                yaxis: {
                    title: {
                        text: 'Total Charges'
                    }
                },
                tooltip: {
                    x: {
                        format: 'dd/MM/yy'
                    },
                },
            }

            var chart = new ApexCharts(
                document.querySelector("#chargeChartContainer"),
                options
            );

            chart.render();
        });
    </script>
    <?php
        include ("../inc/connect.php");
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $query = "SELECT DATE(d_date) AS d_date, SUM(charge) AS charge
                  FROM booking
                  GROUP BY DATE(d_date)";
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
