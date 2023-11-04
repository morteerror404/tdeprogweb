<?php
function criarCarrinhoCompras($idUsuario, $nomeCarrinho) {
    $host = 'localhost';
    $dbname = 'nome_do_banco';
    $username = 'usuario';
    $password = 'senha';

    try {
        // Conexão com o banco de dados usando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Insere um registro na tabela carrinho_de_compras
        $query = "INSERT INTO carrinho_de_compras (id_usuario, nome) VALUES (:id_usuario, :nome)";
        $stmt = $pdo->prepare($query);
        $stmt->bindParam(':id_usuario', $idUsuario);
        $stmt->bindParam(':nome', $nomeCarrinho);
        $stmt->execute();

        // Obtém o último ID inserido (auto increment) na tabela carrinho_de_compras
        $lastId = $pdo->lastInsertId();

        // Cria uma tabela associada ao ID do carrinho de compras
        $queryCreateTable = "CREATE TABLE IF NOT EXISTS carrinho_$lastId (
            id_produto INT,
            nome_produto VARCHAR(100),
            quantidade INT,
            plataforma VARCHAR(50)
        )";
        $pdo->exec($queryCreateTable);

        echo "Carrinho de compras criado com sucesso com ID: $lastId";
    } catch (PDOException $e) {
        echo "Erro ao criar carrinho de compras: " . $e->getMessage();
    }
}

// Utilização da função para criar carrinho de compras
criarCarrinhoCompras(1, 'MeuCarrinho');
?>
