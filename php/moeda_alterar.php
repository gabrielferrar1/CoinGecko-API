<?php 
require 'banco.php';

if (!isset($_GET['id_moeda'])) {
    echo "Erro: O ID da moeda é obrigatório.";
    exit();
}

$id_moeda = $_GET['id_moeda'];
$nome = $_GET['nome'] ?? null;
$simbolo = $_GET['simbolo'] ?? null;
$preco_atual = $_GET['preco_atual'] ?? null;
$capital_mercado = $_GET['capital_mercado'] ?? null;
$percentual_mudanca_preco = $_GET['percentual_mudanca_preco'] ?? null;
$rank_capital_mercado = $_GET['rank_capital_mercado'] ?? null;
$url_imagem = $_GET['url_imagem'] ?? null;

$sql = "UPDATE moedas SET ";
$params = [];
if ($nome !== null) {
    $sql .= "nome = :nome, ";
    $params[':nome'] = $nome;
}
if ($simbolo !== null) {
    $sql .= "simbolo = :simbolo, ";
    $params[':simbolo'] = $simbolo;
}
if ($preco_atual !== null) {
    $sql .= "preco_atual = :preco_atual, ";
    $params[':preco_atual'] = $preco_atual;
}
if ($capital_mercado !== null) {
    $sql .= "capital_mercado = :capital_mercado, ";
    $params[':capital_mercado'] = $capital_mercado;
}
if ($percentual_mudanca_preco !== null) {
    $sql .= "percentual_mudanca_preco = :percentual_mudanca_preco, ";
    $params[':percentual_mudanca_preco'] = $percentual_mudanca_preco;
}
if ($rank_capital_mercado !== null) {
    $sql .= "rank_capital_mercado = :rank_capital_mercado, ";
    $params[':rank_capital_mercado'] = $rank_capital_mercado;
}
if ($url_imagem !== null) {
    $sql .= "url_imagem = :url_imagem, ";
    $params[':url_imagem'] = $url_imagem;
}

$sql = rtrim($sql, ", ");
$sql .= " WHERE id_moeda = :id_moeda";
$params[':id_moeda'] = $id_moeda;

$qry = $con->prepare($sql);
foreach ($params as $key => $value) {
    $qry->bindValue($key, $value);
}

try {
    $qry->execute();
    $nr = $qry->rowCount();
    echo $nr > 0 ? "Moeda com ID $id_moeda atualizada com sucesso." : "Nenhuma moeda encontrada para atualizar.";
} catch (PDOException $e) {
    echo "Erro ao atualizar a moeda: " . $e->getMessage();
}
?>
