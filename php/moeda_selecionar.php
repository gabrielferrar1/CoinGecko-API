<?php 
require 'banco.php';

if (!isset($_GET['nome'])) {
    echo "O nome da moeda deve ser válido";
    exit();
}

$nome = $_GET['nome'];

$sql = "SELECT id_moeda, simbolo, nome, url_imagem, preco_atual, capital_mercado, percentual_mudanca_preco, rank_capital_mercado  
        FROM moedas
        WHERE nome = :nome
        order by id_moeda desc
        limit 10";

$qry = $con->prepare($sql);
$qry->bindParam(':nome', $nome, PDO::PARAM_STR);
$qry->execute();
$registros = $qry->fetchAll(PDO::FETCH_OBJ);

if ($registros) {
    echo json_encode($registros);
} else {
    echo json_encode(["mensagem" => "Nenhuma moeda encontrada com o nome informado."]);
}
?>
