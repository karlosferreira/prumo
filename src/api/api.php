<?php // http://localhost/prumo/api/cnpj/{$cnpj} 
    include_once('../../db.php');
    header("Content-Type:application/json; charset=utf-8");

    if (isset($_GET['cnpj']) && $_GET['cnpj']!="") {
        $cnpj = $_GET['cnpj'];
        $query = "SELECT * FROM `enterprises` WHERE cnpj=$cnpj";
        $result = mysqli_query($db,$query);
        $row = mysqli_fetch_array($result,MYSQLI_ASSOC);

        $cnpjData['enterprise_id'] = $row['enterprise_id'];
        $cnpjData['social_reason'] = $row['social_reason'];
        $cnpjData['cnpj'] = $row['cnpj'];
        $cnpjData['social_capital'] = $row['social_capital'];
        $cnpjData['port_description'] = $row['port_description'];
        $cnpjData['address'] = $row['address'];

        $response["status"] = "true";
        $response["message"] = "Enterprise Details:";
        $response["enterprise"] = $cnpjData;
    } else {
        $response["status"] = "false";
        $response["message"] = "No data found!";
    }

    echo json_encode($response);
    
    exit;
