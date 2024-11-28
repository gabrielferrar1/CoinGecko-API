<?php
header('Content-Type: application/json');
try {
    require 'banco.php';

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    if (isset($data['dataHora'], $data['numeroRegistros'])) {
        $datahora = $data['dataHora'];
        $numeroregistros = intval($data['numeroRegistros']);

        $query = "INSERT INTO log (datahora, numeroregistros) VALUES (:datahora, :numeroregistros)";
        $stmt = $con->prepare($query);
        $stmt->bindParam(':datahora', $datahora);
        $stmt->bindParam(':numeroregistros', $numeroregistros);

        if ($stmt->execute()) {
            echo json_encode(["status" => "sucesso", "mensagem" => "Log registrado com sucesso!"]);
        } else {
            echo json_encode(["status" => "erro", "mensagem" => "Erro ao registrar o log."]);
        }
    } else {
        echo json_encode(["status" => "erro", "mensagem" => "Dados insuficientes fornecidos."]);
    }
} catch (PDOException $e) {
    echo json_encode(["status" => "erro", "mensagem" => "Erro: " . $e->getMessage()]);
}
?>
