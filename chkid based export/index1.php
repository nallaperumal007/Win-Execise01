<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Filtered Records</title>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.1.1/css/buttons.dataTables.min.css">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.36/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.colVis.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.1.1/js/buttons.print.min.js"></script>
<style>
/* General Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
}

.container {
    max-width: 800px;
    margin: 20px auto;
    padding: 0 20px;
}

.form-group {
    margin-bottom: 15px;
}

#chkid {
    width: 200px;
    padding: 8px;
}

.btn {
    padding: 10px 20px;
    background-color: #007bff;
    color: #fff;
    border: none;
    cursor: pointer;
}

.btn:hover {
    background-color: #0056b3;
}

/* Table Styles */
table {
    width: 100%;
    border-collapse: collapse;
}

table th,
table td {
    border: 1px solid #ddd;
    padding: 8px;
    text-align: left;
}

table th {
    background-color: #f2f2f2;
}

/* Responsive Styles */
@media screen and (max-width: 600px) {
    .container {
        padding: 0 10px;
    }
}
</style>
</head>
<body>

<div class="container">
    <h1>Filtered Records</h1>
    <div class="form-group">
        <form id="filterForm">
            <label for="chkid">Chkid:</label>
            <input type="text" name="chkid" id="chkid">
            <button type="submit" class="btn">Generate</button>
        </form>
    </div>

    <div class="table-container">
        <table id="myTable" class="display">
            <thead>
                <tr>
                    <th>S.No</th>
                   <?php
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "stud";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $dbname);

        // Check connection
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Query to get field names from the entry table
        $query = "SHOW COLUMNS FROM student";
        $result = $conn->query($query);

        // Output headers
        if ($result->num_rows > 0) {
          while ($row = $result->fetch_assoc()) {
            echo "<th>" . strtoupper($row["Field"]) . "</th>";
          }
        }

        // Close connection
        $conn->close();
        ?>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<!-- DataTables initialization script -->
<script type="text/javascript">
$(document).ready(function() {
    var table = $('#myTable').DataTable({
        "dom": 'Bfrtip',
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

    $('#filterForm').on('submit', function(e) {
        e.preventDefault();
        // Show loading indicator
        // $('.loading').show();
        $.ajax({
            url: 'fetch_records.php',
            type: 'POST',
            data: $(this).serialize(),
            dataType: 'json',
            success: function(data) {
                // Hide loading indicator
                // $('.loading').hide();
                table.clear().draw();
                if (data.length > 0) {
                    let count = 1;
                    data.forEach(row => {
                        table.row.add([
                            count++,
                            ...Object.values(row)
                        ]).draw(false);
                    });
                }
            },
            error: function(xhr, status, error) {
                // Handle errors here
            }
        });
    });
});
</script>

</body>
</html>
