<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web Page with Header</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa; /* Light background for contrast */
        }
        .header {
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        .logout-select {
            border: 1px solid #ced4da; /* Border color */
            border-radius: 0.25rem; /* Rounded corners */
            padding: 0.375rem 0.75rem; /* Padding for better spacing */
            background-color: #ffffff; /* Background color */
            cursor: pointer; /* Change cursor on hover */
        }
    </style>
</head>
<body>

    <header class="header">
        <div class="container d-flex justify-content-between align-items-center">
            <h1 class="h4">Your Website</h1> <!-- Optional site title -->
             <a href="{{route('welcome')}}"><button class="btn btn-outline-primary">Log Out</button></a>
        </div>
    </header>

    <main class="container mt-4">
        <!-- Your main content goes here -->
    </main>

    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
