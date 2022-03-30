<?php
    header('Content-Type: application/json');
    
    header('Access-Control-Allow-Origin: *');
    
    header("Access-Control-Allow-Methods: DELETE");
    
    // header("Allow: GET, POST, OPTIONS, PUT, DELETE");
    
    // header("Access-Control-Allow-Headers: X-API-KEY, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Access-Control-Allow-Origin");
    header("Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With");

    $data = json_decode(file_get_contents("php://input"), true);

    $student_id = $data["sid"];

    include "conn.php";
    
    $sql = "SELECT id FROM `student` WHERE `id` = {$student_id}";
    $result = mysqli_query($conn, $sql) or die("SQL Query Failed!");
 
    if (mysqli_num_rows($result) > 0) {
        $sql = "DELETE FROM `student` WHERE `id` = {$student_id}";
    
        if (mysqli_query($conn, $sql)) {
            echo json_encode(array("message"=>"Record Deleted Successfully!", "status"=>true));
        } else {
            echo json_encode(array("message"=>"Record Not Deleted Successfully!", "status"=>false));
        }
    } else{
        echo json_encode(array("message"=>"No Record Found!", "status"=>false));
    }
