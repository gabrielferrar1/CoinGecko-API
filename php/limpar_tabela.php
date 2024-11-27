<?php
require 'banco.php';

try {
    $sql = "TRUNCATE TABLE moedas";
    $qry = $con->prepare($sql);
    $qry->execute();

    echo "Tabela limpa com sucesso.";
} catch (PDOException $e) {
    echo "Erro ao limpar a tabela: " . $e->getMessage();
}
?>
