<?php // http://localhost/prumo/api/{$id} 
    include('../../db.php');
    header("Content-Type:application/json; charset=utf-8");

    if (isset($_GET['enterprise_id']) && $_GET['enterprise_id']!="") {
        $enterprise_id = $_GET['enterprise_id'];
        $query = "SELECT * FROM `enterprises` WHERE enterprise_id=$enterprise_id";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $cnpjData['enterprise_id'] = $row['enterprise_id'];
        $cnpjData['social_reason'] = $row['social_reason'];
        $cnpjData['social_capital'] = $row['social_capital'];
        $cnpjData['port_description'] = $row['port_description'];
        $cnpjData['address'] = $row['address'];

        $response["status"] = "true";
        $response["message"] = "Enterprise Details:";
        $response["customers"] = $cnpjData;
    } else {
        $response["status"] = "false";
        $response["message"] = "No data found!";
    }

    echo json_encode($response);
    
    exit;
