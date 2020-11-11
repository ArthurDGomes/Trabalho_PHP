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

    $modeloErro = null;
    $anoErro = null;
    $corErro = null;
    $placaErro = null;

    $modelo = $_POST['modelo'];
    $ano = $_POST['ano'];
    $cor = $_POST['cor'];
    $placa = $_POST['placa'];

    //Validação
    $validacao = true;
    if (empty($modelo)) {
        $modeloErro = 'Por favor, digite o modelo!';
        $validacao = false;
    }

    if (empty($placa)) {
        $placaErro = 'Por favor, digite a placa!';
        $validacao = false;
    }

    if (empty($ano)) {
        $anoErro = 'Por favor, digite o Ano!';
        $validacao = false;
    }

    if (empty($cor)) {
        $corErro = 'Por favor, digite a cor!';
        $validacao = false;
    }

    // update data
    if ($validacao) {
        $pdo = Banco::conectar();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sql = "UPDATE carro  set modelo = ?, ano = ?, cor = ?, placa = ? WHERE id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($modelo, $ano, $cor, $placa, $id));
        Banco::desconectar();
        header("Location: index.php");
    }
} else {
    $pdo = Banco::conectar();
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "SELECT * FROM carro where id = ?";
    $q = $pdo->prepare($sql);
    $q->execute(array($id));
    $data = $q->fetch(PDO::FETCH_ASSOC);
    $modelo = $data['modelo'];
    $ano = $data['ano'];
    $cor = $data['cor'];
    $placa = $data['placa'];
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


    <title>Atualizar Carro</title>
</head>

<body>
<div class="container">

    <div class="span10 offset1">
        <div class="card">
            <div class="card-header">
                <h3 class="well"> Atualizar Carro </h3>
            </div>
            <div class="card-body">
                <form class="form-horizontal" action="update.php?id=<?php echo $id ?>" method="post">

                    <div class="control-group <?php echo !empty($modeloErro) ? 'error' : ''; ?>">
                        <label class="control-label">Modelo</label>
                        <div class="controls">
                            <input name="modelo" class="form-control" size="50" type="text" placeholder="modelo"
                                   value="<?php echo !empty($modelo) ? $modelo : ''; ?>">
                            <?php if (!empty($modeloErro)): ?>
                                <span class="text-danger"><?php echo $modeloErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($anoErro) ? 'error' : ''; ?>">
                        <label class="control-label">Ano</label>
                        <div class="controls">
                            <input name="ano" class="form-control" size="80" type="text" placeholder="Ano"
                                   value="<?php echo !empty($ano) ? $ano : ''; ?>">
                            <?php if (!empty($anoErro)): ?>
                                <span class="text-danger"><?php echo $anoErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($corErro) ? 'error' : ''; ?>">
                        <label class="control-label">Cor</label>
                        <div class="controls">
                            <input name="cor" class="form-control" size="30" type="text" placeholder="Cor"
                                   value="<?php echo !empty($cor) ? $cor : ''; ?>">
                            <?php if (!empty($corErro)): ?>
                                <span class="text-danger"><?php echo $corErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="control-group <?php echo !empty($placaErro) ? 'error' : ''; ?>">
                        <label class="control-label">Placa</label>
                        <div class="controls">
                            <input name="placa" class="form-control" size="40" type="text" placeholder="Placa"
                                   value="<?php echo !empty($placa) ? $placa : ''; ?>">
                            <?php if (!empty($placaErro)): ?>
                                <span class="text-danger"><?php echo $placaErro; ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <br/>
                    <div class="form-actions">
                        <button type="submit" class="btn btn-warning mr-3">Atualizar</button>
                        <a href="index.php" type="btn" class="btn btn-danger">Voltar</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</body>
</html>
