<?php
// Include your database connection
include('connect.php');

try {
    // Query to get the last chkid value excluding the last inserted row
    $sql = "SELECT chkid FROM student ORDER BY id DESC LIMIT 1 OFFSET 1";
    $result = $con->query($sql);

    if ($result->rowCount() > 0) {
        $row = $result->fetch(PDO::FETCH_ASSOC);
        echo $row["chkid"];
    } else {
        echo "0";
    }
} catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
?>
