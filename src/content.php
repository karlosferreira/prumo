<?php 

function the_content($local, $enterprise = []){
    
    switch ($local) {
        case 'api':
            echo "<h5>Dados da Empresa:</h5>";
            echo "<P><b>Razão Social: </b>" . $enterprise['social_reason'] . "</p>";
            echo "<P><b>Registro Nº: </b>" . $enterprise['cnpj'] . "</p>";
            echo "<P><b>Capital Social: </b>R$ " . $enterprise['social_capital'] . "</p>";
            echo "<P><b>Porte: </b>" . $enterprise['porte'] . "</p>";
            echo "<P><b>Endereço: </b>" . $enterprise['address'] . "</p>";

            break;
        default:
            echo "<h5>Dados da Empresa:</h5>";
            echo "<P><b>Razão Social: </b>" . $enterprise['social_reason'] . "</p>";
            echo "<P><b>Registro Nº: </b>" . $enterprise['cnpj'] . "</p>";
            echo "<P><b>Capital Social: </b>R$ " . $enterprise['social_capital'] . "</p>";
            echo "<P><b>Porte: </b>" . $enterprise['port_description'] . "</p>";
            echo "<P><b>Endereço: </b>" . $enterprise['address'] . "</p>";

            break;
    }
}