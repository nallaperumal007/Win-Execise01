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
    // Fetch all records from the student table
    $stmt = $con->prepare("SELECT * FROM student");
    $stmt->execute();
    $students = $stmt->fetchAll(PDO::FETCH_ASSOC);
    echo "Connected successfully";
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    // Initialize $students as an empty array to prevent undefined variable notice
    $students = [];
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Records</title>
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">
    <!-- DataTables Buttons CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.7.1/css/buttons.dataTables.min.css">
    <!-- Custom CSS -->
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        th, td {
            border: 1px solid #dddddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
        tr:nth-child(even) {
            background-color: #ffffff;
        }
        .buttons-container {
            margin-bottom: 20px;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            margin-right: 10px;
        }
        .button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="buttons-container">
        <button onclick="exportData('pdf')" class="button">Export to PDF</button>
        <button onclick="exportData('excel')" class="button">Export to Excel</button>
        <button onclick="exportData('csv')" class="button">Export to CSV</button>
        <button id="printButton" class="button">Print</button>
    </div>

    <table id="student_table" class="display">
        <thead>
            <tr>
                <th>ID</th>
                <th>Registration No</th>
                <th>Name</th>
                <th>Address</th>
                <th>Mark</th>
                <th>Check ID</th>
                <th>Final Total</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['regno']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['address']; ?></td>
                    <td><?php echo $student['mark']; ?></td>
                    <td><?php echo $student['chkid']; ?></td>
                    <td><?php echo $student['finaltot']; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!-- DataTables JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
    <!-- DataTables Buttons JS -->
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>

    <script type="text/javascript">
        $(document).ready(function() {
            // Initialize DataTable
            $('#student_table').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "", // Provide the URL to your server-side script
                    "type": "POST"
                },
                "columns": [
                    { "data": "id" },
                    { "data": "regno" },
                    { "data": "name" },
                    { "data": "address" },
                    { "data": "mark" },
                    { "data": "chkid" },
                    { "data": "finaltot" }
                ],
                "dom": 'lBfrtip',
                "buttons": [
                    {
                        extend: 'collection',
                        text: 'Export',
                        buttons: [
                            'copy',
                            'excel',
                            'csv',
                            'pdf',
                            'print'
                        ]
                    }
                ]
            });

            // Print Button
            $('#printButton').on('click', function() {
                window.print();
            });
        });

        function exportData(format) {
            // Trigger export based on format
            $('#student_table').DataTable().buttons(format).trigger();
        }
    </script>
</body>
</html>
