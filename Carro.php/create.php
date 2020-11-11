

<?php
require 'banco.php';
//Acompanha os erros de validação

// Processar so quando tenha uma chamada post
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $modeloErro = null;
    $anoErro = null;
    $corErro = null;
    $placaErro = null;

    if (!empty($_POST)) {
        $validacao = True;
        $novoUsuario = False;
        if (!empty($_POST['modelo'])) {
            $modelo = $_POST['modelo'];
        } else {
            $modeloErro = 'Por favor, informe o modelo do veículo!';
            $validacao = False;
        }


        if (!empty($_POST['ano'])) {
            $ano = $_POST['ano'];
        } else {
            $anoErro = 'Por favor, informe o ano do veículo';
            $validacao = False;
        }


        if (!empty($_POST['cor'])) {
            $cor = $_POST['cor'];
        } else {
            $corErro = 'Por favor, informe a cor do veículo!';
            $validacao = False;
        }


        if (!empty($_POST['placa'])) {
            $placa = $_POST['placa'];
        } else {
            $placaErro = 'Por favor, informe a placa do veículo!!';
            $validacao = False;
        }
    }

//Inserindo no Banco:
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "INSERT INTO carro (modelo, ano, cor, placa) VALUES(?,?,?,?)";
        $q = $pdo->prepare($sql);
        $q->execute(array($modelo, $ano, $cor, $placa));
        Banco::desconectar();
        header("Location: index.php");
    }
}
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="../assets/css/bootstrap.min.css"-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Adicionar Contato</title>
</head>

<body>
<div class="container">
    <div clas="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Adicionar Carro </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="create.php" method="post">

                    <div class="control-group  <?php echo !empty($modeloErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Modelo</label>
                        <div class="controls">
                            <input size="50" class="form-control" name="modelo" type="text" placeholder="Modelo"
                                   value="<?php echo !empty($modelo) ? $modelo : ''; ?>">
                            <?php if (!empty($modeloErro)): ?>
                                <span class="text-danger"><?php echo $modeloErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($anoErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Ano</label>
                        <div class="controls">
                            <input size="80" class="form-control" name="ano" type="text" placeholder="Ano"
                                   value="<?php echo !empty($ano) ? $ano : ''; ?>">
                            <?php if (!empty($emailErro)): ?>
                                <span class="text-danger"><?php echo $anoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($corErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Cor</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="cor" type="text" placeholder="Cor"
                                   value="<?php echo !empty($cor) ? $cor : ''; ?>">
                            <?php if (!empty($corErro)): ?>
                                <span class="text-danger"><?php echo $corErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($placaErro) ? 'error ' : ''; ?>">
                        <label class="control-label">Placa</label>
                        <div class="controls">
                            <input size="35" class="form-control" name="placa" type="text" placeholder="Placa"
                                   value="<?php echo !empty($placa) ? $placa : ''; ?>">
                            <?php if (!empty($placaErro)): ?>
                                <span class="text-danger"><?php echo $placaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>
                    <div class="form-actions">
                        <br/>
                        <button type="submit" class="btn btn-success mr-3">Adicionar</button>
                        <a href="index.php" type="btn" class="btn btn-danger mr-3">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>

