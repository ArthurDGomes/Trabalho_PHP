

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post



            $funcionario = $_POST['funcionario'];
            $cliente = $_POST['cliente'];
            $placa = $_POST['placa'];
            $placa = $_POST['descricao'];
            $situaos = "teste";

            echo $funcionario;
            echo $cliente;
            echo $placa;
            echo $situaos;

        
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO os (funcionario, cliente, placa, descricao, situaos) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($funcionario, $cliente, $placa, $descricao, $situaos));
        Banco::desconectar();
        header("Location: index.php");
?>