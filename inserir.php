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
    <h2>Adicionar produtos</h2>
      <input type="text" name="nome" placeholder="Nome"/>
      <input type="text" name="estilo" placeholder="Estilo"/>
      <input type="text" name="tempo" placeholder="Tempo"/>
      <input type="text" name="qtde" placeholder="Quantidade em estoque"/>
      <input type="text" name="preco" placeholder="preco"/>
      <input type="text" name="imag" placeholder="imagem"/>
      <button name ="btnenviar">registrar</button>

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
       

    if((!empty($_POST["nome"])) and (!empty($_POST["qtde"])) and (!empty($_POST["preco"])) and (!empty($_POST["imag"]))){
    $nome = $_POST["nome"];
    $estilo = $_POST["estilo"];
    $tempo = $_POST["tempo"];
    $qtde = $_POST["qtde"];
    $preco = $_POST["preco"];
    $imag = $_POST["imag"];


        $sql = "insert into tbGames (nomeGame,estiloGame,tempoGame,qtdeEstoque,precoGame,imagemGame) values('$nome','$estilo',$tempo,$qtde,'$preco','$imag');";
        if($conn->query($sql) === TRUE){
        }
            else{
    
                echo"Erro ao preencher a tabela:" . $conn->error;
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