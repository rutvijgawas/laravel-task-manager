<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Management Home</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <style>
        /* Global Styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-image: url('https://source.unsplash.com/1920x1080/?task,management'); /* Using Unsplash image */
            background-size: cover;
            background-position: center;
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .container {
            text-align: center;
            background-color: rgba(255, 255, 255, 0.8);
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Adding a shadow effect */
            width: 30%;
        }

        /* Dropdown Styles */
        .dropdown {
            margin-top: 20px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        select.form-select {
            width: 200px;
            background-color: #007bff; /* Primary color of Bootstrap */
            border: none;
            color: white;
        }

        /* Button Styles */
        .btn-success {
            margin-top: 20px; /* Adjusted margin */
            margin-bottom: 20px; /* Added margin */
            background-color: #28a745; /* Success color of Bootstrap */
            border: none;
            color: white;
            text-decoration: none;
            padding: 10px 20px;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }

        .btn-success:hover {
            background-color: #218838; /* Darker shade of success color */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Welcome to Task Manager</h1>
        <p>Choose a project and check the task list</p>

        <div class="dropdown">
            <select class="form-select" aria-label="Select Project" name="project_id" onchange="location = 'project/'+this.value;">
                <option selected>Select Project</option>
                @foreach ($projects as $project)
                  <option value="{{$project['id']}}">{{$project['name']}}</option>
                @endforeach
                  <!-- Add more projects here -->
              </select>
        </div>
    </div>
    <script>
    </script>

    <!-- Bootstrap JS and JQuery (required for dropdown) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>
