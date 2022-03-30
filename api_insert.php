<?php

    header('Content-Type: application/json');

    header('Access-Control-Allow-Origin: *');

    header("Access-Control-Allow-Methods: POST");

    header("Allow: GET, POST, OPTIONS, PUT, DELETE");

    // header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");

    $data = json_decode(file_get_contents("php://input"), true);

    $name = $data["sname"];
    $address = $data["saddress"];
    $dob = $data["sdob"];
    $phone = $data["sphone"];
    $course = $data["scourse"];

    include "conn.php";

    $sql = "INSERT INTO `student`(`student_name`, `address`, `dob`, `phone`, `course`) VALUES('{$name}', '{$address}', '{$dob}', '{$phone}', '{$course}')";

    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("message" => "Record Inserted Successfully...", "status" => true));
    } else {
        echo json_encode(array("message" => "Record Not Inserted Successfully!", "status" => false));
    }
    
?>