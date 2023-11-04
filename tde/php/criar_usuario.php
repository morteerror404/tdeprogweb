<?php
function criarUsuario($nome, $email, $senha, $cpf, $telefone) {
    $host = 'localhost';
    $dbname = 'seu_banco_de_dados';
    $username = 'seu_usuario';
    $password = 'sua_senha';

    try {
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $dataCriacao = date('Y-m-d H:i:s'); // Obtém a data e hora atual

        $query = "INSERT INTO usuario (nome, email, senha, data_de_criacao, cpf, telefone) VALUES (:nome, :email, :senha, :data_criacao, :cpf, :telefone)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':nome', $nome);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':senha', $senha);
        $stmt->bindParam(':data_criacao', $dataCriacao);
        $stmt->bindParam(':cpf', $cpf);
        $stmt->bindParam(':telefone', $telefone);
        $stmt->execute();

        echo "Usuário criado com sucesso.";
    } catch (PDOException $e) {
        echo "Erro ao criar usuário: " . $e->getMessage();
    }
}

// Utilização da função para criar um usuário
criarUsuario('Fulano de Tal', 'fulano@example.com', 'senha123', '123.456.789-00', '123456789');
?>

