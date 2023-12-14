<!-- layout/header -->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>
    <div class="container mt-5">
        <h2 class="mb-4">Rooms</h2>

        <div class="mb-3">
            <input class="form-control" type="text" id="search" placeholder="Search...">
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Room Number</th>
                    <th scope="col">Floor</th>
                    <th scope="col">
                        Room Type
                    </th>
                    <th scope="col">
                        Availability
                    </th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php foreach ($data as $key => $room) : ?>
                    <tr>
                        <td><?= $room['roomNumber'] ?></td>
                        <td><?= $room['floor'] ?></td>
                        <td><?= $room['roomType'] ?></td>
                        <td><?= $room['availability'] ?></td>
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