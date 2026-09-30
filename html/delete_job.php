<?php

include 'database/dbconn.php';

if (isset($_GET['id'])) {

    $jobid = $_GET['id'];

    $sql = "DELETE FROM job_allotment WHERE jobid='$jobid'";

    if (mysqli_query($conn, $sql)) {
        header("Location: job_allot.php");
        exit();
    } else {
        echo "Delete Error: " . mysqli_error($conn);
    }
} else {
    echo "Job ID not found";
}

?>




