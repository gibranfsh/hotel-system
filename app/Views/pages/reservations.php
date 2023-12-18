<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservations</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">

    <style>
        /* Custom CSS for setting container width */
        .custom-container {
            max-width: 1750px;
            /* Set your desired width here */
            margin: 0 auto;
            /* Center the container */
        }
    </style>
</head>

<body>
    <div class="custom-container mt-5">
        <h2 class="mb-4">Reservations</h2>

        <div class="mb-3">
            <input class="form-control" type="text" id="search" placeholder="Search...">
        </div>

        <!-- flash success or error-->
        <?php if (session()->getFlashdata('success')) : ?>
            <div class="alert alert-success" role="alert">
                <?= session()->getFlashdata('success') ?>
            </div>
        <?php elseif (session()->getFlashdata('error')) : ?>
            <div class="alert alert-danger" role="alert">
                <?= session()->getFlashdata('error') ?>
            </div>
        <?php endif; ?>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th scope="col">Reservation ID</th>
                    <th scope="col">PIC ID</th>
                    <th scope="col">Guest ID</th>
                    <th scope="col">Guest Name</th>
                    <th scope="col">Phone Number</th>
                    <th scope="col">Email</th>
                    <th scope="col">Room Number</th>
                    <th scope="col">Floor</th>
                    <th scope="col">Check In Date</th>
                    <th scope="col">Check Out Date</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Total Price</th>
                    <th scope='col'>Actions</th>
                </tr>
            </thead>
            <tbody id="tableBody">
                <?php foreach ($data as $key => $reservation) : ?>
                    <tr>
                        <td><?= $reservation['id'] ?></td>
                        <td><?= $reservation['employeeID'] ?></td>
                        <td><?= $reservation['guestID'] ?></td>
                        <td><?= $reservation['guestData']['full_name'] ?></td>
                        <td><?= $reservation['guestData']['phone_number'] ?></td>
                        <td><?= $reservation['guestData']['email'] ?></td>
                        <td><?= $reservation['roomNumber'] ?></td>
                        <td><?= $reservation['floor'] ?></td>
                        <td><?= $reservation['checkInDate'] ?></td>
                        <td><?= $reservation['checkOutDate'] ?></td>
                        <td><?= $reservation['guestData']['created_at'] ?></td>
                        <td><?= $reservation['totalPrice'] ?></td>
                        <td>
                            <!-- Edit button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editModal<?= $key ?>">
                                Edit
                            </button>

                            <!-- Delete button trigger modal -->
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#deleteModal<?= $key ?>">
                                Delete
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
                                            <form action="/reservations/update/<?= $reservation['id'] ?>" method="POST" enctype="multipart/form-data">
                                                <?= csrf_field(); ?>
                                                <input type="hidden" name="_method" value="PUT">
                                                <div class="form-group">
                                                    <label for="editRoomID">Room ID</label>
                                                    <input type="text" class="form-control" id="editRoomID" value="<?= $reservation['roomID'] ?>" readonly>
                                                </div>

                                                <div class="form-group">
                                                    <label for="editCheckInDate">Check-In Date</label>
                                                    <input type="text" class="form-control datepicker" id="editCheckInDate<?= $key ?>" name="editCheckInDate" value="<?= $reservation['checkInDate'] ?>">
                                                </div>
                                                <div class="form-group">
                                                    <label for="editCheckOutDate">Check-Out Date</label>
                                                    <input type="text" class="form-control datepicker" id="editCheckOutDate<?= $key ?>" name="editCheckOutDate" value="<?= $reservation['checkOutDate'] ?>">
                                                </div>
                                                <button type="submit" class="btn btn-primary">Save Changes</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Delete Confirmation Modal -->
                            <div class="modal fade" id="deleteModal<?= $key ?>" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteModalLabel">Delete Reservation</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure you want to delete this reservation?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <!-- Add the delete button here -->
                                            <form action="/reservations/delete/<?= $reservation['id'] ?>" method="POST" style="display: inline;">
                                                <?= csrf_field() ?>
                                                <input type="hidden" name="_method" value="DELETE">
                                                <button type="submit" class="btn btn-danger">Delete</button>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <script>
        $(document).ready(function() {
            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                autoclose: true
            });

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