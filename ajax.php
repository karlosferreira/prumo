<?php
include('db.php');
 
if (isset($_POST['cnpj']) && $_POST['cnpj']!="") {
    $cnpj = $_POST['cnpj'];

    // path of the REST API URL
    $url = "http://localhost/prumo/consulta-cnpj/".$cnpj;
    $enterprise = curl_init($url);
    
    curl_setopt($enterprise,CURLOPT_RETURNTRANSFER,true);

    $response = curl_exec($enterprise);
    $result = json_decode($response);

    if(!$result) {
        echo "Nada encontrado. Tente novamente";
        exit;
    }

    echo "<h3>Enterprise Details:</h3>";

    exit;
}
