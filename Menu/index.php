<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="..\assets\New.css\new.css">
    <title>Menu</title>
</head>
<body>
    <header class="cabecalho">
        <h1> MENU</h1>
    </header>   
    <main class="principal">
        <div class="conteudo">
            <nav class="modulos">
                <div class="modulo rosa">
                    <h3 font color="#FF0000">
                        Cliente 
                    </h3>    
                        <ul>
                            <li><a href="..\Cliente.php\index.php">Cadastrar clientes, fazer alterações no cadastro e/ou exclui-lo</a></li>

                        </ul>
                </div>
                <div class="modulo rosa">
                    <h3>
                        Funcionário 
                    </h3>
                        <ul>
                            <li><a href="..\Funcionario.php\index.php">Cadastrar Funcionário, fazer alterações no cadastro e/ou exclui-lo</a></li>

                        </ul>
                </div>
                <div class="modulo rosa">
                    <h3>
                        Carro 
                    </h3>
                        <ul>
                            <li><a href="..\Carro.php\index.php">Cadastrar Carro, fazer alterações no cadastro e/ou exclui-lo</a></li>

                        </ul>
                </div>
                <div class="modulo rosa">
                    <h3>
                        Ordem de Serviço 
                    </h3>
                        <ul>
                            <li><a href="..\Servico.php\index.php">Cadastrar Ordens de Serviço, fazer movimentação de andamento, adicionar descrição e exclui-las</a></li>
                        </ul>
                </div>
    </main>
    <footer class="rodape">
        Arthur Duarte Gomes © <?= date('Y')?>
    </footer>
</body>
</html>