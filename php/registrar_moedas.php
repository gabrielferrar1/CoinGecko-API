<?php
require_once 'banco.php';

$data = json_decode(file_get_contents("php://input"), true);

if ($data) {
    try {
        $con->beginTransaction();

        $sql = "INSERT INTO moedas 
                (simbolo, nome, url_imagem, preco_atual, capital_mercado, percentual_mudanca_preco, rank_capital_mercado)
                VALUES (:simbolo, :nome, :url_imagem, :preco_atual, :capital_mercado, :percentual_mudanca_preco, :rank_capital_mercado)";

        $stmt = $con->prepare($sql);

        foreach ($data as $moeda) {
            $stmt->bindParam(':simbolo', $moeda['id']);
            $stmt->bindParam(':nome', $moeda['name']);
            $stmt->bindParam(':url_imagem', $moeda['image']);
            $stmt->bindParam(':preco_atual', $moeda['current_price']);
            $stmt->bindParam(':capital_mercado', $moeda['market_cap']);
            $stmt->bindParam(':percentual_mudanca_preco', $moeda['price_change_percentage_24h']);
            $stmt->bindParam(':rank_capital_mercado', $moeda['market_cap_rank']);
            $stmt->execute();
        }

        $con->commit();

        echo "Dados inseridos com sucesso.";
    } catch (PDOException $e) {
        $con->rollBack();
        echo "Erro ao inserir os dados: " . $e->getMessage();
    }
} else {
    echo "Nenhum dado recebido.";
}
?>
