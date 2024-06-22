<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Search</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }
        .container {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        label {
            font-weight: bold;
        }
        input[type="text"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
            $('#chkid').on('input', function(){
                var chkid = $(this).val();
                $.ajax({
                    type: 'POST',
                    url: '',
                    data: {chkid: chkid},
                    success: function(response){
                        $('#result').html(response);
                    }
                });
            });
        });
    </script>
</head>
<body>
    <div class="container">
        <?php
        if(!isset($_POST['chkid'])) {
            // Display search form only if chkid is not set
        ?>
        <h2>Student Search</h2>
        <label for="chkid">Enter Chkid:</label>
        <input type="text" id="chkid" name="chkid">
        <?php
        }
        ?>
        <div id="result">
            <?php
            if(isset($_POST['chkid'])){
                // Database connection
                $servername = "localhost";
                $username = "root"; // Your MySQL username
                $password = ""; // Your MySQL password
                $dbname = "stud";

                // Create connection
                $conn = new mysqli($servername, $username, $password, $dbname);

                // Check connection
                if ($conn->connect_error) {
                    die("Connection failed: " . $conn->connect_error);
                }

                // Fetch data based on chkid
                $chkid = $_POST['chkid'];
                $sql = "SELECT * FROM student WHERE chkid = '$chkid'";
                $result = $conn->query($sql);

                // Display fetched data in table format
                if ($result->num_rows > 0) {
                    echo "<table>
                            <tr>
                                <th>ID</th>
                                <th>Reg No</th>
                                <th>Name</th>
                                <th>Address</th>
                                <th>Mark</th>
                                <th>Chkid</th>
                                <th>Final Total</th>
                            </tr>";
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                                <td>".$row['id']."</td>
                                <td>".$row['regno']."</td>
                                <td>".$row['name']."</td>
                                <td>".$row['address']."</td>
                                <td>".$row['mark']."</td>
                                <td>".$row['chkid']."</td>
                                <td>".$row['finaltot']."</td>
                            </tr>";
                    }
                    echo "</table>";
                } else {
                    echo "No records found";
                }

                // Close connection
                $conn->close();
            }
            ?>
        </div>
    </div>
</body>
</html>
