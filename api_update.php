<?php
    header('Content-Type: application/json');
    
    header('Access-Control-Allow-Origin: *');
    
    header("Access-Control-Allow-Methods: PUT");
    
    // header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    // header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    $data = json_decode(file_get_contents("php://input"), true);

    $id = $data["sid"];
    $name = $data["sname"];
    $address = $data["saddress"];
    $dob = $data["sdob"];
    $phone = $data["sphone"];
    $course = $data["scourse"];

    include "conn.php";
    
    $sql = "UPDATE `student` SET `student_name`='{$name}', `address`='{$address}', `dob`='{$dob}', `phone`='{$phone}', `course`='{$course}' WHERE `id`='{$id}'";
 
    if (mysqli_query($conn, $sql)) {
        echo json_encode(array("message"=>"Record Updated Successfully...", "status"=>true));
    } else {
        echo json_encode(array("message"=>"Record Not Updated Successfully!", "status"=>false));
    }
    
?>