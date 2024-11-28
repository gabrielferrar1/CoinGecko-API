<?php
    require 'banco.php';

    $sql = "select * from log order by idlog";
    $qry = $conexao-> prepare($sql);
    $qry->execute();
    $registros = $qry->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($registros);
?>