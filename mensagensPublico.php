<?php

 ob_start();
 session_start();
 require_once 'dbconnect.php';

 include 'menu.php';
 include 'head.php';


$result = mysqli_query($conn,"SELECT * from mensagens WHERE aprovacao=1");

$tabela = "<ul id='listaMensagens'>";

while ($row = $result->fetch_assoc()) {

	$tabela = $tabela . "<a href='mensagemtrump.php?id=". $row['idMensagem'] ."'><li>" . $row['mensagem'] . "</li></a><br><br><br>";
}

$tabela = $tabela . "</ul>";

echo $tabela;


?>

