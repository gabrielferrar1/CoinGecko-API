<?php
try {
    $con = new PDO("mysql:host=localhost;dbname=coingecko_db;charset=utf8", "root", "");
    $con->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erro de conexão com o banco de dados: " . $e->getMessage());
}
?>
 