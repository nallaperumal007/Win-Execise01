<?php
// session_start();
include('connect.php');
if (isset($_POST['submit'])) {
    $students = [];
    for ($i = 0; $i < count($_POST['slno']); $i++) {
        $student_name = $_POST['student_name'][$i];
        $phone_no = $_POST['phone_no'][$i];
        $age = $_POST['age'][$i];
        $date_of_birth = $_POST['date_of_birth'][$i];
        if ($student_name !== '' && $phone_no !== '' && $age !== '' && $date_of_birth !== '') {
            $students[] = [$student_name, $phone_no, $age, $date_of_birth];
        } else {
            echo '<div class="alert alert-danger" role="alert">Error Submitting Data</div>';
        }
    }

    if (count($students) > 0) {
        $sql = "INSERT INTO student (student_name, phone_no, age, date_of_birth) VALUES (?, ?, ?, ?)";
        $stmt = $con->prepare($sql);
        foreach ($students as $student) {
            $stmt->execute($student);
        }
        echo "<script type='text/javascript'>";
        echo "alert('Submitted successfully')";
        echo "</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inserting Multiple Rows</title>
    <style>
        .container {
            width: 80%;
            padding: 20px;
            margin: auto;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        table, th, td {
            border: 1px solid black;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        .btn {
            padding: 10px 20px;
            margin-top: 10px;
            cursor: pointer;
        }
        .btn-success {
            background-color: green;
            color: white;
        }
        .btn-info {
            background-color: blue;
            color: white;
        }
        .btn-danger {
            background-color: red;
            color: white;
        }
    </style>
</head>
<body>
<div class="container">
    <h3 align="center"><u>Inserting Multiple Rows</u></h3>
    <form action="#" method="post">
        <table id="studentTable">
            <tr>
                <th>Sl No</th>
                <th>Student Name</th>
                <th>Phone No</th>
                <th>Age</th>
                <th>Date of Birth</th>
                <th>Action</th>
            </tr>
            <tr>
                <td><input type="text" name="slno[]" value="1" readonly></td>
                <td><input type="text" name="student_name[]" placeholder="Enter Student Name"></td>
                <td><input type="text" name="phone_no[]" placeholder="Enter Phone No"></td>
                <td><input type="text" name="age[]" placeholder="Enter Age"></td>
                <td><input type="date" name="date_of_birth[]"></td>
                <td><button type="button" class="btn btn-danger btnRemove">Remove</button></td>
            </tr>
        </table>
        <button type="button" id="addrow" class="btn btn-success">Add New Row</button>
        <button type="submit" name="submit" class="btn btn-info">Submit</button>
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
                <td><input type="text" name="student_name[]" placeholder="Enter Student Name"></td>
                <td><input type="text" name="phone_no[]" placeholder="Enter Phone No"></td>
                <td><input type="text" name="age[]" placeholder="Enter Age"></td>
                <td><input type="date" name="date_of_birth[]"></td>
                <td><button type="button" class="btn btn-danger btnRemove">Remove</button></td>
            </tr>
        `;
        $('#studentTable').append(newRow);
    });

    $('body').on('click', '.btnRemove', function() {
        $(this).closest('tr').remove();
        updateSlno();
    });

    function updateSlno() {
        $('#studentTable tr').each(function(index) {
            if(index > 0) {
                $(this).find('td:first input').val(index);
            }
        });
    }
});
</script>
</body>
</html>
