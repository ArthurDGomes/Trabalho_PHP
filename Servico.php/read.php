<?php
require 'banco.php';
$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM os where id = ?";
    $q = $pdo->prepare($sql);//preparando a query 
    $q->execute(array($id));// executa a query
    $data = $q->fetch(PDO::FETCH_ASSOC); //pesquisa os dados e joga na variavel data
    Banco::desconectar();
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="../assets/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Informações da Ordem de Serviço</title>
</head>

<body>
<div class="container">
    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well">Informações da Ordem de Serviço</h3>
            </div>
            <div class="container">
                <div class="form-horizontal">
                    <div class="control-group">
                        <label class="control-label">ID</label>
                        <div class="controls form-control">
                            <label class="carousel-inner">
                                <?php echo $data['id']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Funcionário</label>
                        <div class="controls form-control">
                            <label class="carousel-inner">
                                <?php echo $data['funcionario']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Cliente</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['cliente']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Placa do carro</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['placa']; ?>
                            </label>
                        </div>
                    </div>

                    <div class="control-group">
                        <label class="control-label">Descrição</label>
                        <div class="controls form-control disabled">
                            <label class="carousel-inner">
                                <?php echo $data['descricao']; ?>
                            </label>
                        </div>
                    </div>
                    <div class="control-group">
                        <label class="control-label">Situação da O.S.</label>
                        <div class="controls form-check disabled">
                            <label class="carousel-inner">
                                <?php echo $data['situaos']; ?>
                            </label>
                        </div>
                    </div>
                    <br/>
                    <div class="form-actions">
                        <a href="index.php" type="btn" class="btn btn-danger">Voltar</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
</html>
