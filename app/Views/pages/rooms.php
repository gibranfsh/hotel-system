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
                    <th scope="col">Room ID</th>
                    <th scope="col">Room Number</th>
                    <th scope="col">Floor</th>
                    <th scope="col">Room Type</th>
                    <th scope="col">Availability</th>
                    <th scope="col">Price</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php foreach ($data as $key => $room) : ?>
                    <tr>
                        <td><?= $room['id'] ?></td>
                        <td><?= $room['roomNumber'] ?></td>
                        <td><?= $room['floor'] ?></td>
                        <td><?= $room['roomType'] ?></td>
                        <td><?= $room['availability'] ?></td>
                        <td><?= $room['price'] ?></td>
                        <td>
                            <!-- Edit button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $key ?>">
                                Edit
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="editModal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editModalLabel">Edit Room</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="/rooms/update/<?= $room['id'] ?>" method="POST" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="form-group">
                                                    <label for="editRoomNumber">Room Number</label>
                                                    <input type="text" class="form-control" id="editRoomNumber" value="<?= $room['roomNumber'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editFloor">Floor</label>
                                                    <input type="text" class="form-control" id="editFloor" value="<?= $room['floor'] ?>" readonly>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editRoomType">Room Type</label>
                                                    <select class="form-control" id="editRoomType" name="editRoomType">
                                                        <option value="Deluxe" <?= ($room['roomType'] == 'Deluxe') ? 'selected' : '' ?>>Deluxe</option>
                                                        <option value="Family" <?= ($room['roomType'] == 'Family') ? 'selected' : '' ?>>Family</option>
                                                        <option value="Suite" <?= ($room['roomType'] == 'Suite') ? 'selected' : '' ?>>Suite</option>
                                                        <option value="Superior" <?= ($room['roomType'] == 'Superior') ? 'selected' : '' ?>>Superior</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label for="editAvailability">Availability</label>
                                                    <select class="form-control" id="editAvailability" name="editAvailability">
                                                        <option value="Available" <?= ($room['availability'] == 'Available') ? 'selected' : '' ?>>Available</option>
                                                        <option value="Unavailable" <?= ($room['availability'] == 'Unavailable') ? 'selected' : '' ?>>Unavailable</option>
                                                    </select>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
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