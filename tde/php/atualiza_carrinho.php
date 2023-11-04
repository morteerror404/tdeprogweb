<?php
function adicionarProdutoCarrinho($idCarrinho, $idProduto, $nomeProduto, $quantidade, $plataforma) {
    $host = 'localhost';
    $dbname = 'nome_do_banco';
    $username = 'usuario';
    $password = 'senha';

    try {
        // Conexão com o banco de dados usando PDO
        $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        // Verifica se a tabela associada ao carrinho existe
        $tableName = "carrinho_$idCarrinho";
        $query = "SHOW TABLES LIKE '$tableName'";
        $stmt = $pdo->prepare($query);
        $stmt->execute();

        $tableExists = $stmt->rowCount() > 0;

        if ($tableExists) {
            // A tabela existe, então insere o produto no carrinho
            $insertQuery = "INSERT INTO $tableName (id_produto, nome_produto, quantidade, plataforma) VALUES (:id_produto, :nome_produto, :quantidade, :plataforma)";
            $stmt = $pdo->prepare($insertQuery);
            $stmt->bindParam(':id_produto', $idProduto);
            $stmt->bindParam(':nome_produto', $nomeProduto);
            $stmt->bindParam(':quantidade', $quantidade);
            $stmt->bindParam(':plataforma', $plataforma);
            $stmt->execute();

            echo "Produto adicionado ao carrinho com sucesso.";
        } else {
            echo "Tabela do carrinho não existe.";
        }
    } catch (PDOException $e) {
        echo "Erro ao adicionar produto: " . $e->getMessage();
    }
}

// Utilização da função para adicionar produto ao carrinho
adicionarProdutoCarrinho(1, 123, 'Produto 1', 2, 'Plataforma A');
?>
