<!DOCTYPE html>
<html lang="en">
<head>
  <title>PHP MySQL Ajax Live Search</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<!-- DataTables Buttons CSS -->
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<!-- jQuery -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<!-- DataTables JS -->
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<!-- DataTables Buttons JS -->
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
<style>
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
    .form-outline input[type=text] {
      width: 100%;
      padding: 10px;
      border: 1px solid #ced4da;
      border-radius: 5px;
    }
    .form-outline input[type=text]:focus {
      border-color: #80bdff;
      box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }
    .no-results {
      text-align: center;
      font-size: 18px;
      color: #6c757d;
    }
  </style>
  <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
</head>
<body>
<?php
$servername = "localhost";
$username = "root";  // Default XAMPP username
$password = "";      // Default XAMPP password is empty
$dbname = "stud";

try {
    // Create connection
    $con = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    // Set the PDO error mode to exception
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connected successfully"; 
}
catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}

// Check if the search query is set
if(isset($_POST['search'])) {
    // Get the search query
    $search = $_POST['search'];
    
    // Prepare the SQL statement
    $sql = "SELECT * FROM student WHERE regno LIKE :search OR name LIKE :search";
    $stmt = $con->prepare($sql);
    
    // Bind the parameter
    $stmt->bindParam(':search', $search, PDO::PARAM_STR);
    
    // Execute the query
    $stmt->execute();
    
    // Fetch the results
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // If no search query, fetch all records
    $sql = "SELECT * FROM student";
    $stmt = $con->query($sql);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
}
?>
<div class="container mt-4">
    <h2 class="mb-4"><center>Search</center></h2>
    <div class="mb-4">
        <form method="post" id="searchForm">
            <label for="searchInput" class="form-label"><b>Search Name or Registration Number</b></label>
            <div class="form-outline">
                <input type="text" id="searchInput" name="search" class="form-control" placeholder="Type to search...">
            </div>
        </form>
    </div>                   
    <table class="table table-striped">
        <thead>
          <tr>
            <th>Registration Number</th>
            <th>Name</th>
            <th>Address</th>
            <th>Mark</th>
            <th>Check ID</th>
            <th>Final Total</th>
          </tr>
        </thead>
        <tbody id="showdata">
            <?php if (!empty($results)): ?>
                <?php foreach ($results as $row): ?>
                    <tr>
                        <td><?php echo $row['regno']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['mark']; ?></td>
                        <td><?php echo $row['chkid']; ?></td>
                        <td><?php echo $row['finaltot']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" class="no-results">No matching records found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<script>
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        "dom": 'Bfrtip', // Buttons first, then filter, table, info, pagination
        "buttons": [
            {
                extend: 'excelHtml5',
                title: 'Data export'
            },
            {
                extend: 'csvHtml5',
                title: 'Data export'
            },
            {
                extend: 'pdfHtml5',
                title: 'Data export'
            },
            {
                extend: 'print',
                title: 'Data export'
            }
        ],
    });

    $(document).ready(function(){
        $('#searchInput').on('keyup', function(){
            var searchText = $(this).val().toLowerCase();
            $.ajax({
                url: 'update.php',
                method: 'POST',
                data: {search: searchText},
                success: function(response){
                    $('#showdata').html(response);
                }
            });
        });
    });
</script>
</body>
</html>
