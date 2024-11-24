<?php 
    require 'banco.php';

    $sql = "SELECT id_moeda, simbolo, nome, url_imagem, preco_atual, capital_mercado, percentual_mudanca_preco, rank_capital_mercado 
            FROM moedas 
            ORDER BY id_moeda DESC 
            LIMIT 10";
    $qry = $con->prepare($sql);
    $qry->execute();
    $registros = $qry->fetchAll(PDO::FETCH_OBJ);

    echo json_encode($registros);
?>
