<?php

include 'database/dbconn.php';

if (isset($_GET['id'])) {

    $empid = $_GET['id'];

    $sql = "DELETE FROM employeedetails WHERE empid='$empid'";

    if (mysqli_query($conn, $sql)) {
        header("Location: employees.php");
        exit();
    } else {
        echo "Delete Error: " . mysqli_error($conn);
    }
} else {
    echo "Employee not found";
}

?>




