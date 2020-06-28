<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <script src="jquery-3.4.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="login.css">
    
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
        
<div class="login-page">
  <div class="form" >
    <form class="login-form" action="" method="POST">
      <input type="text" name="usuario" placeholder="Email"/>
      <input type="password" name="senha" placeholder="senha"/>
      <button name ="btnenviar">login</button>
      <p class="message">Não está cadastrado? <a href="cadastrar.php">Criar uma conta</a></p>
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
    $usuario = $_POST["usuario"];
    $senha = $_POST["senha"];

    if((!empty($usuario)) and (!empty($senha))){

      $sql = "select * from tbClientes where email = '$usuario' limit 1";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
          $row = $result -> fetch_assoc();
          
          if(password_verify($senha, $row ["senha"])){

            $_SESSION["usuario_games_store"] = $usuario;
            
            if($usuario == admin){
              header('Location: inserir.php');
            }else{
          header('Location: index.php');
            }  
        }else{
            echo"<h2>Senha incorreta</h2>";
          }
          
        }else{
          echo"<h2>Usuário inválido</h2>";
        }
    }
    }
?>
    
  </div>
</div>
</body>
</html>