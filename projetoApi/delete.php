<?php
require('config.php');

// Converte o método da requisição para minúsculo
$method = strtolower($_SERVER['REQUEST_METHOD']); // Útil para diferenciar os tipos de requisição: GET, POST, DELETE, etc.

if ($method === 'delete') { // Verifica se o método da requisição é DELETE
    // Lê o corpo da requisição e converte em um array associativo
    parse_str(file_get_contents('php://input'), $input);

    // Obtém o valor de id do array $input
    $id = $input['id'] ?? null;

    // Filtra o valor de id para garantir que é válido
    $id = filter_var($id, FILTER_VALIDATE_INT);

    if ($id) { // Verifica se o id foi fornecido e é válido
        // Prepara uma consulta SQL para deletar o registro na tabela notes onde id é igual ao fornecido
        $sql = $pdo->prepare("DELETE FROM notes WHERE id = :id");
        $sql->bindValue(':id', $id, PDO::PARAM_INT); // Associa o valor de id ao parâmetro :id e especifica o tipo como inteiro
        $sql->execute(); // Executa a consulta SQL

        // Verifica se algum registro foi afetado pela operação de deleção
        if ($sql->rowCount() > 0) {
            $array['result'] = 'Registro deletado com sucesso';
        } else {
            $array['error'] = 'Nenhum registro encontrado para deletar';
        }
    } else {
        $array['error'] = 'ID Inexistente ou inválido';
    }
} else {
    $array['error'] = 'Método não aceito';
}

require('return.php');
?>
