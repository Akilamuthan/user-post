<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .sidebar {
            min-height: 100vh;
            background-color: #343a40;
        }
        .sidebar a {
            color: white;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .header {
            background-color: white;
            padding: 10px 20px;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        }
        #message {
    transition: opacity 0.5s ease; /* Smooth transition for opacity */
}
.alert {
    background-color: transparent; /* Or set to your desired color */
}

       #close{
        position: fixed;
        right: 10px;
        top:10px;
       }
    </style>
</head>
<body>
    <div id="message" style="opacity: 1;">
        @if(session("message"))
            <div class="alert alert-success">{{ session("message") }}<p id="close"onclick="message()" style="cursor: pointer;">×</p></div>
            
        @endif
    </div>
    
    
    <div class="d-flex">
        <!-- Sidebar -->
        <nav class="sidebar p-3">
            <h4 class="text-white">Admin Panel</h4>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="{{route('listproduct')}}">List Of Product</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('prodect')}}">prodect</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('setting')}}">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('report')}}">Reports</a>
                </li>
            </ul>
        </nav>

        <div class="flex-grow-1">
            <!-- Header -->
            <header class="header">
                <div class="container d-flex justify-content-between align-items-center">
                    <h1 class="h5">Admin</h1>
                    <div>
                        <span class="mr-3"></span>
                        <a href="{{ route('welcome') }}" class="btn btn-danger">Log Out</a>
                    </div>
                </div>
            </header>
              <!-- Authentication Links -->
              
            <!-- Main Content -->

    
  <main class="position-absolute top-0 start-50 translate-middle">
      @yield('prodect')
    </main>
   
    <!-- Bootstrap JS and dependencies (optional) -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
   
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        var a = document.getElementById("message");
    
        function message() {
    a.style.transition = "opacity 0.5s ease, background-color 0.5s ease"; // Add background transition
    a.style.opacity = "0"; // Fade out the message
    a.style.backgroundColor = "transparent"; // Change background color

    // Optional: Hide the element after fading out
    setTimeout(function() {
        a.style.display = "none"; // Hides the element after fading
    }, 500);
}

    
        // Optional: Call the function after a delay
        
    </script>
    
</body>
</html>
