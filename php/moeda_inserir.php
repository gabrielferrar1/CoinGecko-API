<?php 
require 'banco.php';

if (!isset($_GET['inserir_nome']) || 
    !isset($_GET['inserir_simbolo']) || 
    !isset($_GET['inserir_url_imagem']) || 
    !isset($_GET['inserir_preco_atual']) || 
    !isset($_GET['inserir_capital_mercado']) || 
    !isset($_GET['inserir_percentual_mudanca_preco']) || 
    !isset($_GET['inserir_rank_capital_mercado'])) {
    echo "Erro: Todas as informações devem ser preenchidas.";
    exit();
}

$inserir_simbolo = $_GET['inserir_simbolo']; 
$inserir_nome = $_GET['inserir_nome'];
$inserir_url_imagem = $_GET['inserir_url_imagem'];
$inserir_preco_atual = $_GET['inserir_preco_atual'];
$inserir_capital_mercado = $_GET['inserir_capital_mercado'];
$inserir_percentual_mudanca_preco = $_GET['inserir_percentual_mudanca_preco'];
$inserir_rank_capital_mercado = $_GET['inserir_rank_capital_mercado'];

$sql = "INSERT INTO moedas (simbolo, nome, url_imagem, preco_atual, capital_mercado, percentual_mudanca_preco, rank_capital_mercado) 
        VALUES (:simbolo, :nome, :url_imagem, :preco_atual, :capital_mercado, :percentual_mudanca_preco, :rank_capital_mercado)";
$qry = $con->prepare($sql);
$qry->bindParam(':simbolo', $inserir_simbolo, PDO::PARAM_STR);
$qry->bindParam(':nome', $inserir_nome, PDO::PARAM_STR);
$qry->bindParam(':url_imagem', $inserir_url_imagem, PDO::PARAM_STR);
$qry->bindParam(':preco_atual', $inserir_preco_atual, PDO::PARAM_STR);
$qry->bindParam(':capital_mercado', $inserir_capital_mercado, PDO::PARAM_STR);
$qry->bindParam(':percentual_mudanca_preco', $inserir_percentual_mudanca_preco, PDO::PARAM_STR);
$qry->bindParam(':rank_capital_mercado', $inserir_rank_capital_mercado, PDO::PARAM_INT);

try {
    $qry->execute();
    $nr = $qry->rowCount();
    if ($nr > 0) {
        echo "Moeda '$inserir_nome' inserida com sucesso!";
    } else {
        echo "Erro: Nenhuma linha foi inserida.";
    }
} catch (PDOException $e) {
    echo "Erro ao inserir moeda: " . $e->getMessage();
}
?>
