<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Include Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <style>
        body.default-layout {
            margin: 0;
            padding: 0;
            min-height: 100vh;
            background: linear-gradient(to bottom, #e0f7fa, #b2ebf2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        body.available-classes {
            background: linear-gradient(to bottom, #f1f8e9, #ffffff);
            padding: 0;
        }

        /* Card Styling */
        .custom-card {
            max-width: 500px;
            width: 100%;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Logo Styling */
        .logo {
            width: 150px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body class="@yield('body-class', 'default-layout')">
    <div class="main-container">
        @yield('content')
    </div>
</body>
</html>
