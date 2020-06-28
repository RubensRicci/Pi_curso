<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilo1.css">
</head>
<body>
<div id="menu">
		<ul>
        <li><a href="index.php" target="_self">Games Store</a></li>
		<li><a href="produtos.php" target="_self">Produtos</a></li>
	 	</ul>
        </div>
        <div id="estrutura">
<?php 
    $total = $_POST ["total"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd_games_store";
    
    $conn = new mysqli ($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Falha ao conectar:" . $conn->connect_error);
    }
    $sql = "select * from tbClientes where email = '".$_SESSION["usuario_games_store"]."' limit 1";
      $result = $conn->query($sql);
      if($result->num_rows > 0){
          $row = $result -> fetch_assoc();
          $idcliente = $row ["idCliente"];


      }




        $sql ="SELECT * FROM tbGames WHERE idGame = " . $_SESSION["codigo_produto"];
        $result = $conn->query($sql);
    if($result->num_rows > 0){

        $row = $result->fetch_assoc (); 
        $qtde_atual = $row["qtdeEstoque"];
        $qtde_final = $qtde_atual - $_SESSION["quantidade_produto"];
        
        $sql = "UPDATE tbGames SET qtdeEstoque = $qtde_final WHERE idGame ='".$_SESSION["codigo_produto"]."'";

        if ($conn->query ($sql) === TRUE){
        
        echo "<hl>Obrigado por comprar conosco</h1>";
        //pegando a data atual
        $data = getdate(date ("U")); 
        $dataVenda = "$data[mday] /$data[month] /$data[year]"; 
        //pegando o último código da tabela vendas
        $idVenda;
        
        $sql = "SELECT idVenda FROM tbVendas ORDER BY idVenda DESC LIMIT 1";
        $result = $conn->query ($sql);
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc ();
            $idVenda = $row["idVenda"] + 1;
        }else {
            $idVenda = 1;
         }
        //inserindo a venda na tabela vendas
        $sql = "INSERT INTO tbVendas VALUES ('$idVenda','$dataVenda', '".$_SESSION["quantidade_produto"]."', '$total', '".$_SESSION["codigo_produto"]."','$idcliente') ";
        
        if ($conn->query ($sql) === TRUE) {
            echo "<h2>Venda Realizada com sucesso com sucesso!</h2>";
            header('Location: index.php');
        }
        else{
        echo $conn->error;
        }
    }else{ 
            echo $conn->error;
        } 
    }else { 
            echo "0 resultados:" . $conn->error;
    }
        $conn->close ();
        echo "<form action='index.php' method='POST'>";
        echo "<button name='' value=''>Voltar para a pagina incial</button>"; 
        echo"</form>";
?>
    <br><br> 
</div>

</body> 
</html>