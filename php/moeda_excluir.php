<?php 
require 'banco.php';

if (!isset($_GET['id_moeda'])) {
    echo "Erro: Código da moeda é obrigatório.";
    exit();
}

$id_moeda = $_GET['id_moeda'];

$sql = "DELETE FROM moedas WHERE id_moeda = :id_moeda";
$qry = $con->prepare($sql);
$qry->bindParam(':id_moeda', $id_moeda, PDO::PARAM_INT);
$qry->execute();

$nr = $qry->rowCount();

if ($nr > 0) {
    echo "Moeda com ID $id_moeda excluída com sucesso. Total de registros afetados: $nr.";
} else {
    echo "Nenhuma moeda encontrada com o ID $id_moeda para exclusão.";
}
?>
