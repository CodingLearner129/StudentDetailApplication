<?php
    include "./conn.php";
    session_start();

    session_destroy();

    $conn->close();

    echo "<script>window.location.href = './login.php';</script>";
?>