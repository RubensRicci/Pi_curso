<?php
      session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Games Store</title>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="estiloindex.css">
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
    <p> &nbsp&nbsp Games Store é um website de gestão de direitos digitais criado pela Virugi Corporation ou Virugi L.L.C., de plataformas digitais como jogos e aplicativos de programação e fornece serviços facilitados como compra de jogos, e preços acessíveis aos usuários. Atualmente a Games Store conta com aproximadamente 65 milhões de usuários ativos, e tem médias de acesso diário de 8,5 milhões de usuários ao mesmo tempo.</p>
    </div>
</body>
</html>