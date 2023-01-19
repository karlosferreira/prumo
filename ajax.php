<?php
include('db.php');

if (empty($_POST['cnpj'])) {
    echo "<p class='warning'>Insira um cnpj válido.</p>";
    exit;
}

if (isset($_POST['cnpj']) && !empty($_POST['cnpj'])) {
    $get_post = $_POST['cnpj'];

    $dont_dot = str_replace('.', '', $get_post);
    $dont_hifen = str_replace('-', '', $dont_dot);
    $cnpj = str_replace('/', '', $dont_hifen);

    $length = strlen($cnpj);
    
    if (strlen($cnpj) != 14) {
        echo "<p class='error'>Cnpj inválido. Por favor revise o número do registro.</p>";
        exit;
    }

    $url = "https://publica.cnpj.ws/cnpj/".$cnpj;
    $fetch = curl_init($url);
    
    curl_setopt($fetch,CURLOPT_RETURNTRANSFER,true);

    $response = curl_exec($fetch);
    $result = json_decode($response);

    $social_reason = $result->razao_social;

    $social_capital = $result->capital_social;

    $address = $result->estabelecimento->tipo_logradouro . " " .
    $result->estabelecimento->logradouro . ", " .
    $result->estabelecimento->numero . ". " .
    $result->estabelecimento->complemento . ". " .
    $result->estabelecimento->bairro . ", " .
    $result->estabelecimento->cidade->nome . ", " .
    $result->estabelecimento->estado->nome;

    $porte = $result->porte->descricao;

    if(!$result) {
        echo "<p class='info'>Nada encontrado. Tente novamente</p>";
        exit;
    } else {
        $query = sprintf("INSERT INTO `enterprises` (
            `social_reason`, 
            `social_capital`, 
            `port_description`, 
            `address`
        ) VALUES (
            '%s1',
            '%s2',
            '%s3',
            '%s4'
        )",
            $social_reason,
            $social_capital,
            $porte,
            $address
        );

        mysqli_query($db,$query);
        mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    }

    echo "<h5>Dados da Empresa:</h5>";
    echo "<P><b>Razão Social: </b>" . $social_reason . "</p>";
    echo "<P><b>Capital Social: </b>" . $social_capital . "</p>";
    echo "<P><b>Porte: </b>" . $porte. "</p>";
    echo "<P><b>Endereço: </b>" . $address . "</p>";

    exit;
}
