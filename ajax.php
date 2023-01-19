<?php
include('db.php');
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

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

    if(isset($result->status) && $result->status == 400) {
        echo "<p class='info'>". $result->titulo .": " . $result->detalhes . "</p>";
        exit;
    }

    if(isset($result->status) && $result->status == 429) {
        echo "<p class='info'>". $result->titulo .": " . $result->detalhes . "</p>";
        exit;
    }

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

    if( $result && !isset($result->status) ) {
        $query_get = sprintf("SELECT * FROM `enterprises` WHERE `social_reason` = '%s'", $social_reason);
        $query_fetch = mysqli_query($db, $query_get);

        if ($query_fetch->num_rows <= 0) {
            $query_post = sprintf("INSERT INTO `enterprises` (
                `social_reason`, 
                `social_capital`, 
                `port_description`, 
                `address`
            ) VALUES (
                '%s',
                '%s',
                '%s',
                '%s'
            )",
                $social_reason,
                $social_capital,
                $porte,
                $address
            );
            mysqli_query($db,$query_post);

            echo "<h5>Dados da Empresa:</h5>";
            echo "<P><b>Razão Social: </b>" . $social_reason . "</p>";
            echo "<P><b>Capital Social: </b>" . $social_capital . "</p>";
            echo "<P><b>Porte: </b>" . $porte . "</p>";
            echo "<P><b>Endereço: </b>" . $address . "</p>";
        } else {
            while ($enterprise = mysqli_fetch_array($query_fetch)) {
                echo "<h5>Dados da Empresa:</h5>";
                echo "<P><b>Razão Social: </b>" . $enterprise['social_reason'] . "</p>";
                echo "<P><b>Capital Social: </b>" . $enterprise['social_capital'] . "</p>";
                echo "<P><b>Porte: </b>" . $enterprise['port_description'] . "</p>";
                echo "<P><b>Endereço: </b>" . $enterprise['address'] . "</p>";
            }
        }
    }

    exit;
}
