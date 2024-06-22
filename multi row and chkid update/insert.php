<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Multiple Rows</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 1200px;
            padding: 20px;
            margin: auto;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            margin-top: 40px;
        }
        h3 {
            text-align: center;
            color: #333;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 12px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        .btn {
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .btn-success {
            background-color: #28a745;
            color: #fff;
        }
        .btn-info {
            background-color: #17a2b8;
            color: #fff;
        }
        .btn-danger {
            background-color: #dc3545;
            color: #fff;
        }
        .btn-danger:hover, .btn-success:hover, .btn-info:hover {
            opacity: 0.9;
        }
        @media (max-width: 768px) {
            .container {
                padding: 10px;
            }
            th, td {
                padding: 8px;
            }
            .btn {
                font-size: 14px;
                padding: 8px 16px;
            }
        }
    </style>
</head>
<body>
<div class="container">
    <h3><u>Inserting Multiple Rows</u></h3>
    <form id="studentForm" action="#" method="post">
        <table id="studentTable">
            <thead>
                <tr>
                    <th>Sl No</th>
                    <th>Reg No</th>
                    <th>Name</th>
                    <th>Address</th>
                    <th>Mark</th>
                    <th>Chkid</th>
                    <th>Finaltot</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="slno[]" value="1" readonly></td>
                    <td><input type="text" name="regno[]" placeholder="Enter Reg No"></td>
                    <td><input type="text" name="name[]" placeholder="Enter Name"></td>
                    <td><input type="text" name="address[]" placeholder="Enter Address"></td>
                    <td><input type="text" name="mark[]" placeholder="Enter Mark"></td>
                    <td><input type="text" name="chkid[]" placeholder="Enter Chkid" disabled></td>
                    <td><input type="text" name="finaltot[]" placeholder="Enter Finaltot" disabled></td>
                    <td><button type="button" class="btn btn-danger btnRemove">Remove</button></td>
                </tr>
            </tbody>
        </table>
          <input type="text" class="form-control" name="chkid" id="chkid" required placeholder="chkid">
        
        <button type="button" id="addrow" class="btn btn-success">Add New Row</button>
        <button type="submit" class="btn btn-info">Submit</button>
        
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){

  

    var rowIdx = 1;
    $('#addrow').click(function(){
        rowIdx++;
        var newRow = `
            <tr>
                <td><input type="text" name="slno[]" value="`+rowIdx+`" readonly></td>
                <td><input type="text" name="regno[]" placeholder="Enter Reg No"></td>
                <td><input type="text" name="name[]" placeholder="Enter Name"></td>
                <td><input type="text" name="address[]" placeholder="Enter Address"></td>
                <td><input type="text" name="mark[]" placeholder="Enter Mark"></td>
                <td><input type="text" name="chkid[]" placeholder="Enter Chkid" disabled></td>
                <td><input type="text" name="finaltot[]" placeholder="Enter Finaltot" disabled></td>
                <td><button type="button" class="btn btn-danger btnRemove">Remove</button></td>
            </tr>
        `;
        $('#studentTable tbody').append(newRow);
    });
     
   $.ajax({
        type: 'GET',
        url: 'get_last_chkid.php',
        success: function(data) {
            $('#chkid').val(data);
        }
    });


    $('body').on('click', '.btnRemove', function() {
        $(this).closest('tr').remove();
        updateSlno();
    });
     

    function updateSlno() {
        $('#studentTable tbody tr').each(function(index) {
            $(this).find('td:first input').val(index + 1);
        });
    }

    $('#studentForm').on('submit', function() {
        $('input[name="chkid[]"], input[name="finaltot[]"]').prop('disabled', false);
    });
});
</script>
<?php
// Include your database connection
include('connect.php');

// Function to get the last chkid value
function getLastChkid($con) {
    $sql = "SELECT chkid FROM student ORDER BY id DESC LIMIT 1";
    $result = $con->query($sql);

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        return $row["chkid"];
    } else {
        return 0;
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        // Get the last chkid value
        $lastChkid = getLastChkid($con);

        if (isset($_POST['slno'])) {
            for ($i = 0; $i < count($_POST['slno']); $i++) {
                $regno = $_POST['regno'][$i];
                $name = $_POST['name'][$i];
                $address = $_POST['address'][$i];
                $mark = $_POST['mark'][$i];
                // Increment chkid for each row
                $chkid = $lastChkid + 1 ;
                $finaltot = $_POST['finaltot'][$i];
                
                if ($regno !== '' && $name !== '' && $address !== '' && $mark !== '' && $finaltot == '') {
                    $sql = "INSERT INTO student (regno, name, address, mark, chkid, finaltot) VALUES (?, ?, ?, ?, ?, ?)";
                    $stmt = $con->prepare($sql);
                    $stmt->execute([$regno, $name, $address, $mark, $chkid, $finaltot]);
                } else {
                    echo '<div class="alert alert-danger" role="alert">Error Submitting Data</div>';
                }
            }
            echo "<script type='text/javascript'>";
            echo "alert('Submitted successfully')";
            echo "</script>";
        }
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>

</body>
</html>
