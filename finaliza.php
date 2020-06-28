<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estilofinaliza.css">
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
        <div id="estrutura">
<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd_games_store";

    $conn = new mysqli ($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Falha ao conectar:" . $conn->connect_error);
    }

    $codigo = $_SESSION["codigo_produto"];
    
    $quantidade = $_SESSION["quantidade_produto"] ;

    $sql = "SELECT * FROM tbGames WHERE idGame =" . $codigo;

    $result = $conn->query($sql);
    echo "<h2>Confira as informações</h2>";
    echo "<br><b>Dados do Produto:<b><br>";
    echo "<table border-l width-'708'>";
    echo "<tr>";
    echo "<th width-'50%'>Produto</th>";
    echo "<th width-'10%'>Qtde</th>";
    echo "<th width-'20%'>Preço</th>";
    echo "<th>Total</th>";
    echo "</tr>";

    if($result->num_rows > 0){
    echo "<form action='comprou.php' method='post'>";
    $row = $result->fetch_assoc ();

    echo "<tr><td>";
    echo $row["nomeGame"];
    echo "</td><td>";
    echo $quantidade;
    echo "</Ld><td>";
    $precoGame = $row ["precoGame"];
    echo "R$ " . number_format ($precoGame, 2,',','.'); 
    $total = "R$ " . number_format ($precoGame * $quantidade, 2,',','.');
    echo "</td><td>";
    echo $total;
    echo "</td></tr></table>";
    
    $sql = "select * from tbClientes where email = '".$_SESSION["usuario_games_store"]."' limit 1";
    $result = $conn->query($sql);
    if($result->num_rows > 0){
        $row = $result -> fetch_assoc();

    echo "<br><b>Dados do cliente:<b><br>";
    echo "<table width='708'><tr><td colspan='3'>";
    echo "Nome : ". $row ["nome"];
    echo "</td></tr><tr><td colspan='3'>";
    echo "Endereço: " .  $row ["endereco"];
    echo ", N°: " . $row ["numero"];
    echo " " . $row ["compl"];
    echo "</td></tr><tr><td>";
    echo "CEP: " . $row ["cep"] . "</td><td>";
    echo "cidade: " . $row ["cidade"] . "</td><td>";
    echo "Estado: " . $row ["estado"] . "</td></tr></table>";
    echo "<br><br>";
    }
    echo "<input type='hidden' name='quantidade' value='$quantidade'>"; 
    echo "<button name='total' value='$total'> finalizar compra </button>"; 
    echo "</form>";
    }

    $conn->close();

?>
</div>
</body>
</html>