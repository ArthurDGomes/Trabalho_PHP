<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <title>Ordem de Serviço</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">

</head>
<body class="bg-primary">
        <div class="container bg-light h-auto">
          <div class="jumbotron w-100 bg-dark text-light">
            <div class="row w-100" >
                <h2>Cadastrar Ordem de Serviço</h2>
            </div> 
          </div>
            </br>
            <div class="row">
                <p>
                    <a href="create.php" class="btn btn-success mr-3">Adicionar</a>
                </p>
                <p>
                <a href="..\Menu\index.php" class="btn btn-danger">Voltar</a>
                </p>
            </div> 
            <table class="table table-striped">
                    <thead>
                        <tr>
                            <!--th scope="col">Id</th-->
                            <th scope="col">Funcionario</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Placa do carro</th>
                            <th scope="col">Descrição</th>
                            <th scope="col">Situação da O.S.</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include 'banco.php';
                        $pdo = Banco::conectar();
                        $sql = 'SELECT * FROM os ORDER BY id DESC';

                        foreach($pdo->query($sql)as $row)
                        {
                            echo '<tr>';
			                    //   echo '<th scope="row">'. $row['id'] . '</th>';
                            echo '<td>'. $row['funcionario'] . '</td>';
                            echo '<td>'. $row['cliente'] . '</td>';
                            echo '<td>'. $row['placa'] . '</td>';
                            echo '<td>'. $row['descricao'] . '</td>';
                            echo '<td>'. $row['situaos'] . '</td>';
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
</body>
</html>