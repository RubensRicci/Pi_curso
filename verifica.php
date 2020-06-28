<?php 
// Inicia sessões 
session_start(); 
 
// Verifica se existe os dados da sessão de login 
if(!isset($_SESSION["usuario_games_store"]) || ($_SESSION["usuario_games_store"]=="admin")) 
{ 
// Usuário não logado! Redireciona para a página de login 
header("Location: login2.php"); 
exit; 
} 
?>