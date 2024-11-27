<?php
try {
    require 'banco.php';

    if (isset($_POST['dataHora'], $_POST['numeroRegistros'])) {
        $datahora = $_POST['dataHora'];
        $numeroregistros = intval($_POST['numeroRegistros']);

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
