<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Monthly Reports</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <!-- Add Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Monthly Reports</h2>

        <!-- Add canvas for the chart -->
        <canvas id="revenueChart" width="400" height="200"></canvas>

        <table class="table table-bordered mt-4">
            <thead>
                <tr>
                    <th scope="col">Month</th>
                    <th scope="col">Year</th>
                    <th scope="col">Total Revenue</th>
                </tr>
            </thead>

            <?php
                $sums = [];
                foreach ($data as $report) {
                    $monthYearKey = $report['month'] . '-' . $report['year'];
                    if (!isset($sums[$monthYearKey])) {
                        $sums[$monthYearKey] = 0;
                    }
                    $sums[$monthYearKey] += $report['billTotal'];
                }

                // Sort the array by month and year
                ksort($sums);
            ?>

            <tbody id="tableBody">
                <?php foreach ($sums as $monthYearKey => $totalRevenue) : ?>
                    <?php list($month, $year) = explode('-', $monthYearKey); ?>
                    <tr>
                        <td><?= $month ?></td>
                        <td><?= $year ?></td>
                        <td><?= $totalRevenue ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#search').on('input', function() {
                var searchText = $(this).val().toLowerCase();
                $('#tableBody tr').filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(searchText) > -1);
                });
            });

            // Chart.js configuration for line chart
            var ctx = document.getElementById('revenueChart').getContext('2d');
            var chart = new Chart(ctx, {
                type: 'line',
                data: {
                    labels: <?php echo json_encode(array_keys($sums)); ?>,
                    datasets: [{
                        label: 'Total Revenue',
                        data: <?php echo json_encode(array_values($sums)); ?>,
                        fill: false,
                        borderColor: 'rgba(75, 192, 192, 1)',
                        borderWidth: 2,
                        pointRadius: 4,
                        pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointBorderColor: 'rgba(75, 192, 192, 1)',
                        pointHoverRadius: 6,
                        pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                        pointHoverBorderColor: 'rgba(75, 192, 192, 1)'
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
        });
    </script>
</body>

</html>
