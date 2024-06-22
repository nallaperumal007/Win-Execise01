<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP MySQL Navigation</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
  <style>
    /* Additional CSS for styling */
    body {
      background-color: #f8f9fa;
    }
    .container {
      background-color: #fff;
      border-radius: 8px;
      padding: 20px;
      box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
    }
    .nav-pills {
      display: flex;
      justify-content: center;
      list-style-type: none;
      padding: 0;
    }
    .nav-pills .nav-link {
      color: #fff;
      background-color: #000;
      border-radius: 0px; /* Remove rounded corners */
      margin: 5px; /* Add space between links */
      padding: 10px 20px; /* Add padding to links */
      text-decoration: none; /* Remove underline */
      transition: background-color 0.3s; /* Add transition for smooth hover effect */
    }
    .nav-pills .nav-link:hover {
      background-color: #222; /* Darker background on hover */
    }
    .nav-pills .nav-link.active {
      background-color: #28a745; /* Green color for active link */
    }
  </style>
</head>
<body>
<div class="container mt-4">
    <h2 class="mb-4"><center>Navigation</center></h2>
    <ul class="nav nav-pills">
      <li class="nav-item">
        <a class="nav-link active" href="fetch.php">Fetch Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="insert.php">Insert Data</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="search.php">Search Data</a>
      </li>
    </ul>
</div>
</body>
</html>
