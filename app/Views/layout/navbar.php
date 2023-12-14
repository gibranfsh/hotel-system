<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>GIN Hotel</title>
    <style>
        body {
            padding-top: 56px; /* Adjusted to accommodate the fixed navbar */
        }

        .navbar {
            background-color: #f8f9fa; /* Light gray background */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: bold;
            color: #007bff; /* Blue color */
        }

        .navbar-nav .nav-link {
            color: #343a40; /* Dark gray color */
        }

        .navbar-nav .nav-link:hover {
            color: #0056b3; /* Hover color */
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="container">
            <a class="navbar-brand" href="/">GIN Hotel</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/reservations">Reservations</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/rooms">Rooms</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/reports">Reports</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Your page content goes here -->

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
