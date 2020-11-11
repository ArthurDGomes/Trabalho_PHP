

<?php
require '../Funcionario.php/banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $funcionarioErro = null;
    $clienteErro = null;
    $placaErro = null;
    $descricaoErro = null;
    $situaosErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['funcionario'])) {
            $funcionario = $_POST['funcionario'];
        } else {
            $funcionarioErro = 'Por favor escolha o seu funcionario!';
            $validacao = False;
        }


        if (!empty($_POST['cliente'])) {
            $cliente = $_POST['cliente'];
        } else {
            $clienteErro = 'Por favor digite o nome do cliente';
            $validacao = False;
        }


        if (!empty($_POST['placa'])) {
            $placa = $_POST['placa'];
        } else {
            $placaErro = 'Por favor digite o número da placa do carro!';
            $validacao = False;
        }

        if (!empty($_POST['descricao'])) {
            $descricao = $_POST['descricao'];
        } else {
            $placaErro = 'Por favor digite a descrição da o.s.!';
            $validacao = False;
        }

        if (!empty($_POST['situaos'])) {
            $situaos = $_POST['situaos'];
        } else {
            $situaosErro = 'Por favor seleccione um campo!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO os (funcionario, cliente, placa, descricao, situaos) VALUES(?,?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($funcionario, $cliente, $placa, $descricao, $situaos));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Adicionar Ordem de Serviço</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Ordem de Serviço </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="./create.php" method="post">

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

