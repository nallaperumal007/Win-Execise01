<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <style>
        /* Your CSS styles */
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
    <form id="studentForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
        <!-- Input field to display last chkid value -->
        <?php
        // Include your database connection file
        include('connect.php');

        // Fetch the last chkid value from the database
        $sqlLastChkid = "SELECT chkid FROM student ORDER BY id DESC LIMIT 1";
        $stmtLastChkid = $con->prepare($sqlLastChkid);
        $stmtLastChkid->execute();
        $lastChkid = $stmtLastChkid->fetch(PDO::FETCH_ASSOC);

        $lastChkidValue = $lastChkid['chkid']; // Retrieve the last chkid value
        ?>

        <!-- Display the last chkid value in the input field -->
        <input type="text" id="chkidInput" name="chkidInput" value="<?php echo $lastChkidValue; ?>">
        <!-- End of input field for last chkid value -->

        <!-- Rest of your form -->
        <input type="text" hidden name="slno[]" readonly>
        <button type="button" id="backButton">Back</button>
        <button type="button" id="changeButton">Change</button>

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
    <div style="margin-bottom: 20px;">
        <input type="text" id="searchInput" placeholder="Search by Chkid">
        <button id="searchButton" class="btn btn-info">Search</button>
    </div>
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

// Check if the request is for changing chkid
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['change'])) {
    // Get the new chkid value
    $newChkidValue = $_POST['chkidInput'];
    
    // Update all records with the new chkid value
    $sql = "UPDATE student SET chkid = ?";
    $stmt = $con->prepare($sql);
    $stmt->execute([$newChkidValue]);

    // Return a response to the AJAX request
    if ($stmt->rowCount() > 0) {
        echo "success"; // Return success message to AJAX
        exit(); // Stop further execution
    } else {
        echo "error"; // Return error message to AJAX
        exit(); // Stop further execution
    }
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
                $sql = "INSERT INTO student (regno, chkid) VALUES (?, ?)";
                $stmt = $con->prepare($sql);
                $stmt->execute([$regno, $_POST['chkidInput']]);
            } else { 
                echo '<div class="alert alert-danger" role="alert">Error Submitting Data</div>';
            }
        }
    }
}
?>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
$(document).ready(function(){
    // Click event for the "Back" button
    $('#backButton').click(function(){
        var chkidInput = $('#chkidInput');
        var currentChkidValue = parseInt(chkidInput.val());
        chkidInput.val(currentChkidValue + 1);
    });

    // Click event for the "Change" button
    $('#changeButton').click(function(){
        var newChkidValue = $('#chkidInput').val().trim(); // Get the new chkid value
        if (newChkidValue !== '') {
            $.ajax({
                type: 'POST',
                url: '<?php echo $_SERVER['PHP_SELF']; ?>', // Replace with the actual PHP file name
                data: { change: true, chkidInput: newChkidValue }, // Send the new chkid value
                success: function(response){
                    if(response === "success") {
                        alert("Chkid updated successfully");
                        // Update the UI to reflect the new chkid value if needed
                    } else {
                        alert("Chkid updated successfully");
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText);
                    alert("Failed to update Chkid. Check console for details.");
                }
            });
        } else {
            alert("Please enter a valid Chkid value");
        }
    });

    // AJAX request for delete operation
    $('.remove-btn').click(function(){
        var regNo = $(this).val();
        $.ajax({
            type: 'POST',
            url: '<?php echo $_SERVER['PHP_SELF']; ?>', // Change to the actual PHP file name
            data: { delete: regNo },
            success: function(response){
                if(response === "success") {
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
            url: '<?php echo $_SERVER['PHP_SELF']; ?>', // Change to the actual PHP file name
            data: { cancel: regNo },
            success: function(response){
                if(response === "success") {
                    alert("Chkid value set to null successfully");
                    // Optionally, you can update the row in the table here
                } else {
                    alert("Failed to cancel operation");
                }
            }
        });
    });

    // Search functionality
    $('#searchButton').click(function(){
        var searchText = $('#searchInput').val().trim().toLowerCase();
        if (searchText === '') {
            // If search input is empty, show all rows
            $('#studentTable tbody tr').show();
        } else {
            // Hide rows that don't match the search text
            $('#studentTable tbody tr').each(function(){
                var chkid = $(this).find('.chkid-input').val().trim().toLowerCase();
                if (chkid.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        }
    });
});
</script>

</body>
</html>
