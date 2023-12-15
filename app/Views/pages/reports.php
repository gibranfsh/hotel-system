<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Monthly Reports</h2>

        <table class="table table-bordered">
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
        });
    </script>
</body>

</html>