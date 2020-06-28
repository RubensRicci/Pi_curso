<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estiloProd.css">
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

    $sql = "select * from tbGames;";
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {

        echo "<form action='compra.php' method='POST'>";
        while($row = $result -> fetch_assoc())
        {
            if($row["qtdeEstoque"]>0)
            {
                echo "<div id='games'>";
                echo $row ["nomeGame"];
                echo "<br>";
                echo "<img src='imagens\\". $row["imagemGame"] ."'>";
                echo "<br>";
                echo "R$ " . number_format($row["precoGame"],2,',','.');
                echo "<br>";
                echo "<button name='codigo' value='". $row["idGame"] . "'>Comprar</button>";
                echo "</div>";
            }
        }
        echo"</form>";
    }
    else
    {
        echo"0 resultados";
    }
    $conn->close();
?>
</div>
</body>
</html>