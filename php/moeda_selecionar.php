<?php
require 'banco.php';

if (!isset($_GET['id']) && !isset($_GET['nome'])) {
    echo json_encode(["mensagem" => "Por favor, forneça o ID ou o Nome da moeda para a busca."]);
    exit();
}

$id = isset($_GET['id']) ? $_GET['id'] : null;
$nome = isset($_GET['nome']) ? $_GET['nome'] : null;

$sql = "SELECT id_moeda, simbolo, nome, url_imagem, preco_atual, capital_mercado, percentual_mudanca_preco, rank_capital_mercado  
        FROM moedas
        WHERE 1=1";

if ($id) {
    $sql .= " AND id_moeda = :id";
}

if ($nome) {
    $sql .= " AND nome LIKE :nome";
}

$sql .= " ORDER BY id_moeda DESC LIMIT 10";

$qry = $con->prepare($sql);

if ($id) {
    $qry->bindParam(':id', $id, PDO::PARAM_INT);
}

if ($nome) {
    $nome = '%' . $nome . '%';
    $qry->bindParam(':nome', $nome, PDO::PARAM_STR);
}

$qry->execute();
$registros = $qry->fetchAll(PDO::FETCH_OBJ);

if ($registros) {
    echo json_encode($registros);
} else {
    echo json_encode(["mensagem" => "Nenhuma moeda encontrada com os critérios informados."]);
}
?>
