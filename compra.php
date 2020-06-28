<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estiloCompra.css">
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
    $codigo = $_POST["codigo"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "bd_games_store";

    $conn = new mysqli ($servername, $username, $password, $dbname);

    if($conn->connect_error){
        die("Falha ao conectar:" . $conn->connect_error);
    }

    $sql = "select * from tbGames where idGame = " . $codigo;
    $result = $conn->query($sql);
    if($result->num_rows > 0)
    {

        echo "<form action='' method='POST'>";
        while($row = $result -> fetch_assoc())
        {
                echo "<h1>" . $row ["nomeGame"] . "</h1>";
                echo  "<div id='game'>";
                echo  "<div id='imagem'>";
                echo "<img src='imagens\\". $row["imagemGame"] ."'>";
                echo "</div>";
                echo  "<div id='descricao'>";
                echo"<b style='font-size:20px;line-height: 30px;'>Descricao:</b><br>";
                echo "Nome: " . $row ["nomeGame"] .".<br>";
                echo "Estilo: " . $row ["estiloGame"] .".<br>";
                echo "Tempo de jogo: " . $row ["tempoGame"] ."h<br>";
                echo"<b style='font-size:35px;line-height: 40px;'>";
                echo "Preco: R$ " . number_format($row["precoGame"],2,',','.');
                echo "</b><br>";
                $qtdeEstoque = $row["qtdeEstoque"];
                $t=0;
                echo "Quantidade: <select name='quantidade'>";
                for($i =1; $i <=$qtdeEstoque ;$i++){
                    echo "<option>$i</option>";
                }
                echo"</select>";
                echo "<br><br>";
                echo "<input type='hidden' name='codigo' value='$codigo'>";
                echo "<button name='btnenviar'>Comprar</button>";
                echo "</div>";
                echo "</div>";
        }

        echo"</form>";
    }
    else
    {
        echo"0 resultados";
    }
    $conn->close();

    if(isset($_POST["btnenviar"])){
        $_SESSION["codigo_produto"] = $_POST["codigo"];
        $_SESSION["quantidade_produto"] = $_POST["quantidade"];

        require "verifica.php";
        header('Location: finaliza.php');
    }


?>
    </div>
</body>
</html>