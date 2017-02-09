<?php

 require_once 'dbconnect.php';
 include 'head.php';
 include 'menuAdmin.php'; 

 // if session is not set this will redirect to login page
 if( !isset($_SESSION['idAdmin']) ) {
  header("Location: index.php");
  exit;
 }

$result = mysqli_query($conn,"SELECT * from mensagens WHERE aprovacao =0");

$tabelaPorAprovar = "<ul id='listaMensagensAprovadas'>";
while ($row = $result->fetch_assoc()) {
	$tabelaPorAprovar = $tabelaPorAprovar . "<a href='mensagemtrump.php?id=". $row['idMensagem'] ."' id='li_mensagem'><li>" . $row['mensagem'] . "</li></a><br><br>";
 
	  $tabelaPorAprovar = $tabelaPorAprovar . "<li id='li_botoes'><form action='' id='form_aceitar' method='POST' onsubmit='return confirm(\"Pretende aprovar esta mensagem?\")'>";
    $tabelaPorAprovar = $tabelaPorAprovar . "<input type='text' value='".$row['idMensagem'] ."' name='mensagemAprovada' style='display:none'>";
    $tabelaPorAprovar = $tabelaPorAprovar . "<input id='botao_aceitar' type='submit' name='aprovar' value='Aprovar'></form></li>";
   
    $tabelaPorAprovar = $tabelaPorAprovar . "<form action='' id='form_rejeitar' method='POST' onsubmit='return confirm(\"Pretende rejeitar esta mensagem?\")'>";
    $tabelaPorAprovar = $tabelaPorAprovar . "<input type='text' value='".$row['idMensagem'] ."' name='mensagemRejeitada' style='display:none'>";
    $tabelaPorAprovar = $tabelaPorAprovar . "<input id='botao_rejeitar' type='submit' name='rejeitar' value='Rejeitar'></form></li>";

}
$tabelaPorAprovar = $tabelaPorAprovar . "</ul>";


$resultAprovadas = mysqli_query($conn,"SELECT * from mensagens WHERE aprovacao =1");

$tabelaAprovadas = "<ul id='listaMensagensAprovadas'>";
while ($row = $resultAprovadas->fetch_assoc()) {
	$tabelaAprovadas = $tabelaAprovadas . "<a href='mensagemtrump.php?id=". $row['idMensagem'] ."' id='li_mensagem'><li>" . $row['mensagem'] . "</li></a><br><br>";

		$tabelaAprovadas = $tabelaAprovadas . "<li id='li_botoes'><form action='' id='form_aceitar' method='POST' onsubmit='return confirm(\"Pretende rejeitar esta mensagem?\")'>";
    $tabelaAprovadas = $tabelaAprovadas . "<input type='text' value='".$row['idMensagem'] ."' name='mensagemRejeitada' style='display:none'>";
    $tabelaAprovadas = $tabelaAprovadas . "<input id='botao_rejeitar' type='submit' name='rejeitar' value='Rejeitar'></form></li><br>";
}

$tabelaAprovadas = $tabelaAprovadas . "</ul>";



$resultRejeitadas = mysqli_query($conn,"SELECT * from mensagens WHERE aprovacao =2");

$tabelaRejeitadas = "<ul id='listaMensagensAprovadas'>";
while ($row = $resultRejeitadas->fetch_assoc()) {
	$tabelaRejeitadas = $tabelaRejeitadas . "<a href='mensagemtrump.php?id=". $row['idMensagem'] ."' id='li_mensagem'><li>" . $row['mensagem'] . "</li></a><br><br>";

	$tabelaRejeitadas = $tabelaRejeitadas . "<li id='li_botoes'><form action='' id='form_aceitar' method='POST' onsubmit='return confirm(\"Pretende aprovar esta mensagem?\")'>";
    $tabelaRejeitadas = $tabelaRejeitadas . "<input type='text' value='".$row['idMensagem'] ."' name='mensagemAprovada' style='display:none'>";
    $tabelaRejeitadas = $tabelaRejeitadas . "<input id='botao_aceitar' type='submit' name='aprovar' value='Aprovar'></form><br>";
}
$tabelaRejeitadas = $tabelaRejeitadas . "</ul>";


if(isset($_POST["aprovar"])) {
   $sql = mysqli_query($conn, "UPDATE mensagens SET aprovacao=1 WHERE idMensagem='" .$_POST['mensagemAprovada']."'");
    header("Location: ". $_SERVER['REQUEST_URI']);
}

if(isset($_POST["rejeitar"])) {
   $sql = mysqli_query($conn, "UPDATE mensagens SET aprovacao=2 WHERE idMensagem='" .$_POST['mensagemRejeitada']."'");
    header("Location: ". $_SERVER['REQUEST_URI']);
}
?>


<div id="gestaoMensagens">

<h3> Mensagens por aprovar </h3>
<?php echo $tabelaPorAprovar; ?>

<h3> Mensagem aprovadas </h3>
<?php echo $tabelaAprovadas; ?>

<h3> Mensagens rejeitadas </h3>
<?php echo $tabelaRejeitadas; ?>

</div>


<?php 
  $conn->close();
?>