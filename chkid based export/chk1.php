<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f2f5;
            margin: 0;
            padding: 0;
        }
        .container {
            max-width: 600px;
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
    <form id="studentForm" action="#" method="post">
        <input type="text" name="re" value="100" placeholder="Enter Reg No">
        <input type="text" hidden name="slno[]" value="1" readonly>
        <table id="studentTable">
            <thead>
                <tr>
                    <th style="background-color: #17a2b8; color: #fff;">Reg No</th>
                    <th style="background-color: #17a2b8; color: #fff;">Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="regno[]" placeholder="Enter Reg No"></td>
                    <td><button type="submit" class="btn btn-info">Submit</button></td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

<?php
// Include your database connection file
include('connect.php');

$totalMarks = 0;

// Retrieve data from the database and display it in a table
$sql = "SELECT * FROM student";
$stmt = $con->prepare($sql);
$stmt->execute();

if ($stmt->rowCount() > 0) {
    echo "<form method='post' id='updateForm'>";
    echo "<table>";
    echo "<tr>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>ID</th>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>Reg No</th>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>Name</th>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>Mark</th>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>Chkid</th>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>Finaltot</th>";
    echo "<th style='background-color: #17a2b8; color: #fff;'>Action</th>";
    echo "</tr>";

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<tr>";
        echo "<td><input type='hidden' name='id[]' value='" . $row['id'] . "'>" . $row['id'] . "</td>";
        echo "<td>" . $row['regno'] . "</td>";
        echo "<td>" . $row['name'] . "</td>";
        echo "<td><input type='text' class='mark-input' value='" . $row['mark'] . "' readonly></td>";
        echo "<td><input type='text' name='chkid[]' class='chkid-input' value='" . $row['chkid'] . "'></td>";
        echo "<td><input type='text' name='finaltot[]' class='finaltot-input' value='" . $row['finaltot'] . "' readonly></td>";
        echo "<td>";
        echo "<button type='submit' class='remove-btn btn btn-danger' name='delete' value='" . $row['regno'] . "'>Delete</button>";  
        echo "<button type='submit' class='cancel-btn btn btn-success' name='cancel' value='" . $row['regno'] . "'>Cancel</button>";
        echo "</td>";
        echo "</tr>";
        
        // Increment total marks
        $totalMarks += $row['mark'];
    }
    echo "</table>";
    echo "<div id='totalMarks'>";
    echo "<div style='text-align: center;'>";
    echo "<label for='totalMarksInput' style='color: #333;'><b>Total Marks:</b></label>";
    echo "<input type='text' id='totalMarksInput' name='totalMarks' value='" . $totalMarks . "' style='color: #333;'>";
    echo "</div>";
    echo "</div>";
    echo "<div class='form-control'>";
    echo "<button type='submit' form='updateForm' name='update' style='background-color: red; color: white;'><b>Update</b></button>";
    echo "</div>";
    echo "</form>";
} else {
    echo "<p style='text-align: center; color: red;'>No data found for the provided range of registration numbers.</p>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update'])) {
    $ids = $_POST['id'];
    $chkids = $_POST['chkid'];
    $totalMarks = $_POST['totalMarks'];

    for ($i = 0; $i < count($ids); $i++) {
        $sql = "UPDATE student SET  finaltot = ? WHERE id = ?";
        $stmt = $con->prepare($sql);
        $stmt->execute([$totalMarks, $ids[$i]]);
    }
    echo "<script type='text/javascript'>";
    echo "alert('Updated successfully');";
    echo "</script>";
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete'])) {
    $regNoToDelete = $_POST['delete'];
    $sql = "DELETE FROM student WHERE regno = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$regNoToDelete]);
    echo "success"; // Return success message to AJAX
    exit(); // Stop further execution
}

// Handling cancel button action
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cancel'])) {
    $regNoToCancel = $_POST['cancel'];
    $sql = "UPDATE student SET chkid = NULL WHERE regno = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$regNoToCancel]);
    echo "success"; // Return success message to AJAX
    exit(); // Stop further execution
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['slno'])) {
        for ($i = 0; $i < count($_POST['slno']); $i++) {
            $regno = $_POST['regno'][$i];
           
            if ($regno !== '') {
                $sql = "INSERT INTO student (regno,chkid) VALUES (?,'".$_POST['re']."')";
                $stmt = $con->prepare($sql);
                $stmt->execute([$regno]);
            } else { 
                echo '<div class="alert alert-danger" role="alert">Error Submitting Data</div>';
            }
        }
       // echo "<script type='text/javascript'>";
       // echo "alert('Submitted successfully')";
       // echo "</script>";
    }
}
?>

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
               
                <td><button type="button" class="btn btn-danger btnRemove">Remove</button></td>
            </tr>
        `;
        $('#studentTable tbody').append(newRow);
    });
$(document).ready(function(){
    // Calculate total marks on page load
    calculateTotalMarks();
    
    // Calculate total marks when mark input changes
    $('body').on('input', '.mark-input', function() {
        calculateTotalMarks();
    });

    function calculateTotalMarks() {
        var total = 0;
        $('.mark-input').each(function() {
            var mark = parseInt($(this).val()) || 0;
            total += mark;
        });
        $('#totalMarksInput').val(total);
    }
});
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function(){
        // AJAX request for delete operation
        $('.remove-btn').click(function(){
            var regNo = $(this).val();
            $.ajax({
                type: 'POST',
                url: '', // Change to the actual PHP file name
                data: { delete: regNo },
                success: function(response){
                    if(response == "success") {
                        alert("Record deleted successfully");
                        // Optionally, you can remove the row from the table here
                    } else {
                        alert("Failed to delete record");
                    }
                }
            });
        });

        // AJAX request for cancel operation
        $('.cancel-btn').click(function(){
            var regNo = $(this).val();
            $.ajax({
                type: 'POST',
                url: '', // Change to the actual PHP file name
                data: { cancel: regNo },
                success: function(response){
                    if(response == "success") {
                        alert("Chkid value set to null successfully");
                        // Optionally, you can update the row in the table here
                    } else {
                        alert("Failed to cancel operation");
                    }
                }
            });
        });
    });
</script>

</script>

</body>
</html>
