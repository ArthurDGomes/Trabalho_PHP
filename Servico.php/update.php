<?php

require 'banco.php';

$id = null;
if (!empty($_GET['id'])) {
    $id = $_REQUEST['id'];
}

if (null == $id) {
    header("Location: index.php");
}

if (!empty($_POST)) {

    $funcionarioErro = null;
    $clienteErro = null;
    $placaErro = null;
    $descricaoErro = null;
    $situaosErro = null;

    $funcionario = $_POST['funcionario'];
    $cliente = $_POST['cliente'];
    $placa = $_POST['placa'];
    $descricao = $_POST['descricao'];
    $situaos = $_POST['situaos'];

    //Validação
    $validacao = true;
    if (empty($funcionario)) {
        $funcionarioErro = 'Por favor digite o funcionario!';
        $validacao = false;
    }


    if (empty($cliente)) {
        $clienteErro = 'Por favor digite nome do cliente!';
        $validacao = false;
    }

    if (empty($placa)) {
        $placaErro = 'Por favor digite a placa do carro!';
        $validacao = false;
    }

    if (empty($situaos)) {
        $situaosErro = 'Por favor preenche o campo!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE os  set funcionario = ?, cliente = ?, placa = ?, descricao = ?, situaos = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($funcionario, $cliente, $placa,$descricao, $situaos, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM os where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $funcionario = $data['funcionario'];
    $cliente = $data['cliente'];
    $placa = $data['placa'];
    $descricao = $data['descricao'];
    $situaos = $data['situaos'];
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

    <title>Atualizar Ordem de Serviço</title>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Ordem de Serviço </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

                <div class="control-group  <?php echo !empty($funcionarioErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Funcionário</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="funcionario" type="text" placeholder="Funcionário"
                                   value="<?php echo !empty($funcionario) ? $funcionario : ''; ?>">
                            <?php if (!empty($funcionarioErro)): ?>
                                <span class="text-danger"><?php echo $funcionarioErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($clienteErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Cliente</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="cliente" type="text" placeholder="Cliente"
                                   value="<?php echo !empty($cliente) ? $cliente : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $clienteErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($placaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Placa do carro</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="placa" type="text" placeholder="Placa do carro"
                                   value="<?php echo !empty($placa) ? $placa : ''; ?>">
                            <?php if (!empty($placaErro)): ?>
                                <span class="text-danger"><?php echo $placaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($descricaoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Descrição da O.S.</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="descricao" type="text" placeholder="Descrição da O.S."
                                   value="<?php echo !empty($descricao) ? $descricao : ''; ?>">
                            <?php if (!empty($descricaoErro)): ?>
                                <span class="text-danger"><?php echo $descricaoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php !empty($situaosErro) ? 'echo($situaosErro)' : ''; ?>">
                        <div class="controls">
                            <label class="control-label">Situação da O.S.</label>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" type="radio" name="situaos" id="situaos"
                                           value="Em andamento" <?php isset($_POST["situaos"]) && $_POST["situaos"] == "Em andamento" ? "checked" : null; ?>/>
                                    Em andamento</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="situaos" name="situaos" type="radio"
                                           value="Concluída" <?php isset($_POST["situaos"]) && $_POST["situaos"] == "Concluída" ? "checked" : null; ?>/>
                                    Concluída</p>
                            </div>
                            <div class="form-check">
                                <p class="form-check-label">
                                    <input class="form-check-input" id="situaos" name="situaos" type="radio"
                                           value="Cancelada" <?php isset($_POST["situaos"]) && $_POST["situaos"] == "Cancelada" ? "checked" : null; ?>/>
                                    Cancelada</p>
                            </div>
                            <?php if (!empty($situaosErro)): ?>
                                <span class="help-inline text-danger"><?php echo $situaosErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success mr-3">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-danger">Voltar</a>
                        
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
