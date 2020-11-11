<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <!-- Latest compiled and minified CSS -->
    <!--link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/new.css/container.css"-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

    <title>Carro</title>
</head>

<body class="bg-primary">
        <div class="container bg-light h-auto">
          <div class="jumbotron w-100 bg-dark text-light">
            <div class="row w-100" >
                <h2>Cadastrar Carro</h2>
            </div> 
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success mr-3">Adicionar</a>
                </p>
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <!--th scope="col">Id</th-->
                            <th scope="col">Modelo</th>
                            <th scope="col">Ano</th>
                            <th scope="col">Cor</th>
                            <th scope="col">Placa</th>
                        </tr>
                    </thead>
                    <tr>
                        <div class="form-actions">
                        <a href="..\Menu\index.php" type="btn" class="btn btn-danger ">Voltar</a>
                    </div>
                        </tr>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM Carro ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
			                    //   echo '<th scope="row">'. $row['id'] . '</th>';
                            echo '<td>'. $row['modelo'] . '</td>';
                            echo '<td>'. $row['ano'] . '</td>';
                            echo '<td>'. $row['cor'] . '</td>';
                            echo '<td>'. $row['placa'] . '</td>';
                            echo '<td width=250>';
                            echo '<a class="btn btn-primary" href="read.php?id='.$row['id'].'">Info</a>';
                            echo ' ';
                            echo '<a class="btn btn-warning" href="update.php?id='.$row['id'].'">Atualizar</a>';
                            echo ' ';
                            echo '<a class="btn btn-danger" href="delete.php?id='.$row['id'].'">Excluir</a>';
                            echo '</td>';
                            echo '</tr>';
                        }
                        Banco::desconectar();
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
</body>
</html>
