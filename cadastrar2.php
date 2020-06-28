<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <script src="jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="cadastrar.css">
    
</head>
<body>
<div id="menu">
		<ul>
        <li><a href="index.php" target="_self">Games Store</a></li>
        <li><a href="produtos.php" target="_self">Produtos</a></li>
        
        <li class="dropdown">
            <a href="login.php" class="dropbtn">login</a>
			<div class="dropdown-content">
            <?php
            echo '<a href="logout.php?token='.md5(session_id()).'">sair</a>';
            ?>
			</div>
          </li>
	 	</ul>
        </div>
        
<div class="regis-page">
  <div class="form" >
    <form class="regis-form" action="" method="POST">
        <h2>Cadastro</h2>
      <input type="text" name="nome" placeholder="nome"/>
      <input type="text" name="usuario" placeholder="Email"/>
      <input type="password" name="senha" placeholder="Senha"/>
      <input type="password" name="confirma" placeholder="Confirmar senha"/>
      <input type="text" name="cpf" placeholder="cpf"/>
      <input type="text" name="endereco" placeholder="Endereço"/>
      <input type="text" name="num" placeholder="Número"/>
      <input type="text" name="compl" placeholder="Complemento"/>
      <input type="text" name="cep" placeholder="Cep"/>
      <input type="text" name="cidade" placeholder="Cidade"/>
      <input type="text" name="estado" placeholder="Estado"/>
      <button name ="btnenviar">cadastrar</button>
      <p class="message">Já está cadastrado? <a href="login.php">Login</a></p>
      <hr>

      <?php
      
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "bd_games_store";

      $conn = new mysqli ($servername, $username, $password, $dbname);
  
      if($conn->connect_error){
          die("Falha ao conectar:" . $conn->connect_error);
      }
      echo"</form>";
      if(isset($_POST["btnenviar"])){
       

    if((!empty($_POST["nome"])) and (!empty($_POST["usuario"])) and (!empty($_POST["senha"])) and (!empty($_POST["confirma"])) and (!empty($_POST["cpf"]))){
    $nome = $_POST["nome"];
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];
    $confirma = $_POST["confirma"];
    $cpf = $_POST["cpf"];
    $endereco = $_POST["endereco"];
    $num = $_POST["num"];
    $compl = $_POST["compl"];
    $cep = $_POST["cep"];
    $cidade = $_POST["cidade"];
    $estado = $_POST["estado"];
    
    $sql = "select * from tbClientes where email='$usuario'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "<h2>Email já cadastrado</h2>";
    }else{


    
    $sql = "select * from tbClientes where cpf='$cpf'";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        echo "<h2>CPF já cadastrado</h2>";
    }else{
    
        if($confirma == $senha){
    $senha = password_hash($senha, PASSWORD_DEFAULT);

        $sql = "insert into tbClientes (nome,email,cpf,endereco,numero,compl,cep,cidade,estado,senha) values ('$nome','$usuario','$cpf','$endereco','$num','$compl','$cep','$cidade','$estado','$senha')";
        if($conn->query($sql) === TRUE){
            $_SESSION["usuario_games_store"] = $usuario;
            header('Location: finaliza.php');
        }
            else{
    
                echo"Erro ao preencher a tabela:" . $conn->error;
                }
        }else{
        echo"<h2>Senhas diferentes</h2>";
        }
    }
}  
    }else{
        echo"<h2>Dados não preenchidos</h2>";
    }
}
?>
    
  </div>
</div>
</body>
</html>